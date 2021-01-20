<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateLoanAPIRequest;
use App\Http\Requests\API\Admin\UpdateLoanAPIRequest;
use App\Models\Admin\Loan;
use App\Repositories\Admin\LoanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LoanController
 * @package App\Http\Controllers\API\Admin
 */

class LoanAPIController extends AppBaseController
{
    /** @var  LoanRepository */
    private $loanRepository;

    public function __construct(LoanRepository $loanRepo)
    {
        $this->loanRepository = $loanRepo;
    }

    /**
     * Display a listing of the Loan.
     * GET|HEAD /loans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $loans = $this->loanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($loans->toArray(), 'Loans retrieved successfully');
    }

    /**
     * Store a newly created Loan in storage.
     * POST /loans
     *
     * @param CreateLoanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLoanAPIRequest $request)
    {
        $input = $request->all();

        $loan = $this->loanRepository->create($input);

        return $this->sendResponse($loan->toArray(), 'Loan saved successfully');
    }

    /**
     * Display the specified Loan.
     * GET|HEAD /loans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Loan $loan */
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            return $this->sendError('Loan not found');
        }

        return $this->sendResponse($loan->toArray(), 'Loan retrieved successfully');
    }

    /**
     * Update the specified Loan in storage.
     * PUT/PATCH /loans/{id}
     *
     * @param int $id
     * @param UpdateLoanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLoanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Loan $loan */
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            return $this->sendError('Loan not found');
        }

        $loan = $this->loanRepository->update($input, $id);

        return $this->sendResponse($loan->toArray(), 'Loan updated successfully');
    }

    /**
     * Remove the specified Loan from storage.
     * DELETE /loans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Loan $loan */
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            return $this->sendError('Loan not found');
        }

        $loan->delete();

        return $this->sendSuccess('Loan deleted successfully');
    }
}
