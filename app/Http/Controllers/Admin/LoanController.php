<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\LoanDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateLoanRequest;
use App\Http\Requests\Admin\UpdateLoanRequest;
use App\Repositories\Admin\LoanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LoanController extends AppBaseController
{
    /** @var  LoanRepository */
    private $loanRepository;

    public function __construct(LoanRepository $loanRepo)
    {
        $this->loanRepository = $loanRepo;
    }

    /**
     * Display a listing of the Loan.
     *
     * @param LoanDataTable $loanDataTable
     * @return Response
     */
    public function index(LoanDataTable $loanDataTable)
    {
        return $loanDataTable->render('admin.loans.index');
    }

    /**
     * Show the form for creating a new Loan.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.loans.create');
    }

    /**
     * Store a newly created Loan in storage.
     *
     * @param CreateLoanRequest $request
     *
     * @return Response
     */
    public function store(CreateLoanRequest $request)
    {
        $input = $request->all();

        $loan = $this->loanRepository->create($input);

        Flash::success('Loan saved successfully.');

        return redirect(route('admin.loans.index'));
    }

    /**
     * Display the specified Loan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('admin.loans.index'));
        }

        return view('admin.loans.show')->with('loan', $loan);
    }

    /**
     * Show the form for editing the specified Loan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('admin.loans.index'));
        }

        return view('admin.loans.edit')->with('loan', $loan);
    }

    /**
     * Update the specified Loan in storage.
     *
     * @param  int              $id
     * @param UpdateLoanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLoanRequest $request)
    {
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('admin.loans.index'));
        }

        $loan = $this->loanRepository->update($request->all(), $id);

        Flash::success('Loan updated successfully.');

        return redirect(route('admin.loans.index'));
    }

    /**
     * Remove the specified Loan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('admin.loans.index'));
        }

        $this->loanRepository->delete($id);

        Flash::success('Loan deleted successfully.');

        return redirect(route('admin.loans.index'));
    }
}
