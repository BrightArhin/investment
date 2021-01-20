<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateDepartment_DivisionAPIRequest;
use App\Http\Requests\API\Admin\UpdateDepartment_DivisionAPIRequest;
use App\Models\Admin\Department_Division;
use App\Repositories\Admin\Department_DivisionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Department_DivisionController
 * @package App\Http\Controllers\API\Admin
 */

class Department_DivisionAPIController extends AppBaseController
{
    /** @var  Department_DivisionRepository */
    private $departmentDivisionRepository;

    public function __construct(Department_DivisionRepository $departmentDivisionRepo)
    {
        $this->departmentDivisionRepository = $departmentDivisionRepo;
    }

    /**
     * Display a listing of the Department_Division.
     * GET|HEAD /departmentDivisions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $departmentDivisions = $this->departmentDivisionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($departmentDivisions->toArray(), 'Department  Divisions retrieved successfully');
    }

    /**
     * Store a newly created Department_Division in storage.
     * POST /departmentDivisions
     *
     * @param CreateDepartment_DivisionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartment_DivisionAPIRequest $request)
    {
        $input = $request->all();

        $departmentDivision = $this->departmentDivisionRepository->create($input);

        return $this->sendResponse($departmentDivision->toArray(), 'Department  Division saved successfully');
    }

    /**
     * Display the specified Department_Division.
     * GET|HEAD /departmentDivisions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Department_Division $departmentDivision */
        $departmentDivision = $this->departmentDivisionRepository->find($id);

        if (empty($departmentDivision)) {
            return $this->sendError('Department  Division not found');
        }

        return $this->sendResponse($departmentDivision->toArray(), 'Department  Division retrieved successfully');
    }

    /**
     * Update the specified Department_Division in storage.
     * PUT/PATCH /departmentDivisions/{id}
     *
     * @param int $id
     * @param UpdateDepartment_DivisionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartment_DivisionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Department_Division $departmentDivision */
        $departmentDivision = $this->departmentDivisionRepository->find($id);

        if (empty($departmentDivision)) {
            return $this->sendError('Department  Division not found');
        }

        $departmentDivision = $this->departmentDivisionRepository->update($input, $id);

        return $this->sendResponse($departmentDivision->toArray(), 'Department_Division updated successfully');
    }

    /**
     * Remove the specified Department_Division from storage.
     * DELETE /departmentDivisions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Department_Division $departmentDivision */
        $departmentDivision = $this->departmentDivisionRepository->find($id);

        if (empty($departmentDivision)) {
            return $this->sendError('Department  Division not found');
        }

        $departmentDivision->delete();

        return $this->sendSuccess('Department  Division deleted successfully');
    }
}
