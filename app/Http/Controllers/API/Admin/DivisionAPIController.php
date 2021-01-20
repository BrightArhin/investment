<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateDivisionAPIRequest;
use App\Http\Requests\API\Admin\UpdateDivisionAPIRequest;
use App\Models\Admin\Division;
use App\Repositories\Admin\DivisionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DivisionController
 * @package App\Http\Controllers\API\Admin
 */

class DivisionAPIController extends AppBaseController
{
    /** @var  DivisionRepository */
    private $divisionRepository;

    public function __construct(DivisionRepository $divisionRepo)
    {
        $this->divisionRepository = $divisionRepo;
    }

    /**
     * Display a listing of the Division.
     * GET|HEAD /divisions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $divisions = $this->divisionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($divisions->toArray(), 'Divisions retrieved successfully');
    }

    /**
     * Store a newly created Division in storage.
     * POST /divisions
     *
     * @param CreateDivisionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDivisionAPIRequest $request)
    {
        $input = $request->all();

        $division = $this->divisionRepository->create($input);

        return $this->sendResponse($division->toArray(), 'Division saved successfully');
    }

    /**
     * Display the specified Division.
     * GET|HEAD /divisions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Division $division */
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            return $this->sendError('Division not found');
        }

        return $this->sendResponse($division->toArray(), 'Division retrieved successfully');
    }

    /**
     * Update the specified Division in storage.
     * PUT/PATCH /divisions/{id}
     *
     * @param int $id
     * @param UpdateDivisionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDivisionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Division $division */
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            return $this->sendError('Division not found');
        }

        $division = $this->divisionRepository->update($input, $id);

        return $this->sendResponse($division->toArray(), 'Division updated successfully');
    }

    /**
     * Remove the specified Division from storage.
     * DELETE /divisions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Division $division */
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            return $this->sendError('Division not found');
        }

        $division->delete();

        return $this->sendSuccess('Division deleted successfully');
    }
}
