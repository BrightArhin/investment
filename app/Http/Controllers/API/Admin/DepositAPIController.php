<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateDepositAPIRequest;
use App\Http\Requests\API\Admin\UpdateDepositAPIRequest;
use App\Models\Admin\Deposit;
use App\Repositories\Admin\DepositRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DepositController
 * @package App\Http\Controllers\API\Admin
 */

class DepositAPIController extends AppBaseController
{
    /** @var  DepositRepository */
    private $depositRepository;

    public function __construct(DepositRepository $depositRepo)
    {
        $this->depositRepository = $depositRepo;
    }

    /**
     * Display a listing of the Deposit.
     * GET|HEAD /deposits
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $deposits = $this->depositRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($deposits->toArray(), 'Deposits retrieved successfully');
    }

    /**
     * Store a newly created Deposit in storage.
     * POST /deposits
     *
     * @param CreateDepositAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDepositAPIRequest $request)
    {
        $input = $request->all();

        $deposit = $this->depositRepository->create($input);

        return $this->sendResponse($deposit->toArray(), 'Deposit saved successfully');
    }

    /**
     * Display the specified Deposit.
     * GET|HEAD /deposits/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Deposit $deposit */
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            return $this->sendError('Deposit not found');
        }

        return $this->sendResponse($deposit->toArray(), 'Deposit retrieved successfully');
    }

    /**
     * Update the specified Deposit in storage.
     * PUT/PATCH /deposits/{id}
     *
     * @param int $id
     * @param UpdateDepositAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepositAPIRequest $request)
    {
        $input = $request->all();

        /** @var Deposit $deposit */
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            return $this->sendError('Deposit not found');
        }

        $deposit = $this->depositRepository->update($input, $id);

        return $this->sendResponse($deposit->toArray(), 'Deposit updated successfully');
    }

    /**
     * Remove the specified Deposit from storage.
     * DELETE /deposits/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Deposit $deposit */
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            return $this->sendError('Deposit not found');
        }

        $deposit->delete();

        return $this->sendSuccess('Deposit deleted successfully');
    }
}
