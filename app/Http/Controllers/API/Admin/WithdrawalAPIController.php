<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateWithdrawalAPIRequest;
use App\Http\Requests\API\Admin\UpdateWithdrawalAPIRequest;
use App\Models\Admin\Withdrawal;
use App\Repositories\Admin\WithdrawalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class WithdrawalController
 * @package App\Http\Controllers\API\Admin
 */

class WithdrawalAPIController extends AppBaseController
{
    /** @var  WithdrawalRepository */
    private $withdrawalRepository;

    public function __construct(WithdrawalRepository $withdrawalRepo)
    {
        $this->withdrawalRepository = $withdrawalRepo;
    }

    /**
     * Display a listing of the Withdrawal.
     * GET|HEAD /withdrawals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $withdrawals = $this->withdrawalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($withdrawals->toArray(), 'Withdrawals retrieved successfully');
    }

    /**
     * Store a newly created Withdrawal in storage.
     * POST /withdrawals
     *
     * @param CreateWithdrawalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateWithdrawalAPIRequest $request)
    {
        $input = $request->all();

        $withdrawal = $this->withdrawalRepository->create($input);

        return $this->sendResponse($withdrawal->toArray(), 'Withdrawal saved successfully');
    }

    /**
     * Display the specified Withdrawal.
     * GET|HEAD /withdrawals/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Withdrawal $withdrawal */
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            return $this->sendError('Withdrawal not found');
        }

        return $this->sendResponse($withdrawal->toArray(), 'Withdrawal retrieved successfully');
    }

    /**
     * Update the specified Withdrawal in storage.
     * PUT/PATCH /withdrawals/{id}
     *
     * @param int $id
     * @param UpdateWithdrawalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWithdrawalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Withdrawal $withdrawal */
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            return $this->sendError('Withdrawal not found');
        }

        $withdrawal = $this->withdrawalRepository->update($input, $id);

        return $this->sendResponse($withdrawal->toArray(), 'Withdrawal updated successfully');
    }

    /**
     * Remove the specified Withdrawal from storage.
     * DELETE /withdrawals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Withdrawal $withdrawal */
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            return $this->sendError('Withdrawal not found');
        }

        $withdrawal->delete();

        return $this->sendSuccess('Withdrawal deleted successfully');
    }
}
