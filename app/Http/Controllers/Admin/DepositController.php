<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DepositDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateDepositRequest;
use App\Http\Requests\Admin\UpdateDepositRequest;
use App\Models\Admin\Member;
use App\Models\Admin\Transaction;
use App\Repositories\Admin\DepositRepository;
use App\Repositories\Admin\TransactionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DepositController extends AppBaseController
{
    /** @var  DepositRepository */
    private $depositRepository;
    private $transactionRepository;

    public function __construct(DepositRepository $depositRepo, TransactionRepository $transactionRepo)
    {
        $this->depositRepository = $depositRepo;
        $this->transactionRepository = $transactionRepo;
    }

    /**
     * Display a listing of the Deposit.
     *
     * @param DepositDataTable $depositDataTable
     * @return Response
     */
    public function index(DepositDataTable $depositDataTable)
    {
        return $depositDataTable->render('admin.deposits.index');
    }

    /**
     * Show the form for creating a new Deposit.
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

       return view('admin.deposits.create',compact(['members_array']));
    }

    /**
     * Store a newly created Deposit in storage.
     *
     * @param CreateDepositRequest $request
     *
     * @return Response
     */
    public function store(CreateDepositRequest $request)
    {
        $input = $request->all();
        $transaction_exist= Transaction::where('member_id', $input['member_id'])->first();
        if($transaction_exist != null){
            $transaction_latest = Transaction::where('member_id', $input['member_id'])->latest()->first();
            $transaction = $this->transactionRepository->create([
                    'member_id'=>$input['member_id'],
                    'transaction_type'=>$input['transaction_type'],
                    'transaction_date'=>$input['deposit_date'],
                    'amount'=>$input['amount'],
                    'balance'=>$transaction_latest->balance + $input['amount']
                ]);
        }else{
            $transaction = $this->transactionRepository->create([
                'member_id'=>$input['member_id'],
                'transaction_type'=>$input['transaction_type'],
                'transaction_date'=>$input['deposit_date'],
                'amount'=>$input['amount'],
                'balance'=>$input['amount']
                ]);
        }



        $deposit = $this->depositRepository->create([
            'member_id'=>$input['member_id'],
            'deposit_date'=>$input['deposit_date'],
            'reference'=>$input['reference'],
            'narration'=>$input['narration'],
            'amount'=>$input['amount'],
            'transaction_id'=>$transaction->id
            ]);


        Flash::success('Deposit saved successfully.');

        return redirect(route('admin.deposits.index'));
    }

    /**
     * Display the specified Deposit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            Flash::error('Deposit not found');

            return redirect(route('admin.deposits.index'));
        }

        return view('admin.deposits.show')->with('deposit', $deposit);
    }

    /**
     * Show the form for editing the specified Deposit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            Flash::error('Deposit not found');

            return redirect(route('admin.deposits.index'));
        }

        return view('admin.deposits.edit')->with('deposit', $deposit);
    }

    /**
     * Update the specified Deposit in storage.
     *
     * @param  int              $id
     * @param UpdateDepositRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepositRequest $request)
    {
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            Flash::error('Deposit not found');

            return redirect(route('admin.deposits.index'));
        }

        $deposit = $this->depositRepository->update($request->all(), $id);

        Flash::success('Deposit updated successfully.');

        return redirect(route('admin.deposits.index'));
    }

    /**
     * Remove the specified Deposit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            Flash::error('Deposit not found');

            return redirect(route('admin.deposits.index'));
        }

        $this->depositRepository->delete($id);

        Flash::success('Deposit deleted successfully.');

        return redirect(route('admin.deposits.index'));
    }
}
