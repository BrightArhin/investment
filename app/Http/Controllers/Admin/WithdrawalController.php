<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WithdrawalDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateWithdrawalRequest;
use App\Http\Requests\Admin\UpdateWithdrawalRequest;
use App\Models\Admin\Member;
use App\Models\Admin\Transaction;
use App\Repositories\Admin\TransactionRepository;
use App\Repositories\Admin\WithdrawalRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class WithdrawalController extends AppBaseController
{
    /** @var  WithdrawalRepository */
    private $withdrawalRepository;
    private $transactionRepository;

    public function __construct(WithdrawalRepository $withdrawalRepo, TransactionRepository $transRepo)
    {
        $this->withdrawalRepository = $withdrawalRepo;
        $this->transactionRepository = $transRepo;
    }

    /**
     * Display a listing of the Withdrawal.
     *
     * @param WithdrawalDataTable $withdrawalDataTable
     * @return Response
     */
    public function index(WithdrawalDataTable $withdrawalDataTable)
    {
        return $withdrawalDataTable->render('admin.withdrawals.index');
    }

    /**
     * Show the form for creating a new Withdrawal.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $members_array = array();
        $members = Member::all();
        foreach ($members as $member){
            $members_array[$member->id] = $member->user->name;
        }
        return view('admin.withdrawals.create', compact(['members_array']));
    }

    /**
     * Store a newly created Withdrawal in storage.
     *
     * @param CreateWithdrawalRequest $request
     *
     * @return Response
     */
    public function store(CreateWithdrawalRequest $request)
    {
        $input = $request->all();
        $transaction_latest = Transaction::where('member_id', $input['member_id'])->latest()->first();
        $transaction = $this->transactionRepository->create([
            'member_id'=>$input['member_id'],
            'transaction_type'=>$input['transaction_type'],
            'transaction_date'=>$input['withdrawal_date'],
            'amount'=>$input['amount'],
            'balance'=>$transaction_latest->balance - $input['amount']
        ]);


        $withdrawal = $this->withdrawalRepository->create([
            'member_id'=>$input['member_id'],
            'withdrawal_date'=>$input['withdrawal_date'],
            'reference'=>$input['reference'],
            'amount'=>$input['amount'],
            'transaction_id'=>$transaction->id
        ]);



        Flash::success('Withdrawal saved successfully.');

        return redirect(route('admin.withdrawals.index'));
    }

    /**
     * Display the specified Withdrawal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            Flash::error('Withdrawal not found');

            return redirect(route('admin.withdrawals.index'));
        }

        return view('admin.withdrawals.show')->with('withdrawal', $withdrawal);
    }

    /**
     * Show the form for editing the specified Withdrawal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            Flash::error('Withdrawal not found');

            return redirect(route('admin.withdrawals.index'));
        }

        return view('admin.withdrawals.edit')->with('withdrawal', $withdrawal);
    }

    /**
     * Update the specified Withdrawal in storage.
     *
     * @param  int              $id
     * @param UpdateWithdrawalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWithdrawalRequest $request)
    {
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            Flash::error('Withdrawal not found');

            return redirect(route('admin.withdrawals.index'));
        }

        $withdrawal = $this->withdrawalRepository->update($request->all(), $id);

        Flash::success('Withdrawal updated successfully.');

        return redirect(route('admin.withdrawals.index'));
    }

    /**
     * Remove the specified Withdrawal from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            Flash::error('Withdrawal not found');

            return redirect(route('admin.withdrawals.index'));
        }

        $this->withdrawalRepository->delete($id);

        Flash::success('Withdrawal deleted successfully.');

        return redirect(route('admin.withdrawals.index'));
    }
}
