<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateDepartment_DivisionRequest;
use App\Http\Requests\Admin\UpdateDepartment_DivisionRequest;
use App\Repositories\Admin\Department_DivisionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Department_DivisionController extends AppBaseController
{
    /** @var  Department_DivisionRepository */
    private $departmentDivisionRepository;

    public function __construct(Department_DivisionRepository $departmentDivisionRepo)
    {
        $this->departmentDivisionRepository = $departmentDivisionRepo;
    }

    /**
     * Display a listing of the Department_Division.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $departmentDivisions = $this->departmentDivisionRepository->paginate(10);

        return view('admin.department__divisions.index')
            ->with('departmentDivisions', $departmentDivisions);
    }

    /**
     * Show the form for creating a new Department_Division.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.department__divisions.create');
    }

    /**
     * Store a newly created Department_Division in storage.
     *
     * @param CreateDepartment_DivisionRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartment_DivisionRequest $request)
    {
        $input = $request->all();

        $departmentDivision = $this->departmentDivisionRepository->create($input);

        Flash::success('Department  Division saved successfully.');

        return redirect(route('admin.departmentDivisions.index'));
    }

    /**
     * Display the specified Department_Division.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $departmentDivision = $this->departmentDivisionRepository->find($id);

        if (empty($departmentDivision)) {
            Flash::error('Department  Division not found');

            return redirect(route('admin.departmentDivisions.index'));
        }

        return view('admin.department__divisions.show')->with('departmentDivision', $departmentDivision);
    }

    /**
     * Show the form for editing the specified Department_Division.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $departmentDivision = $this->departmentDivisionRepository->find($id);

        if (empty($departmentDivision)) {
            Flash::error('Department  Division not found');

            return redirect(route('admin.departmentDivisions.index'));
        }

        return view('admin.department__divisions.edit')->with('departmentDivision', $departmentDivision);
    }

    /**
     * Update the specified Department_Division in storage.
     *
     * @param int $id
     * @param UpdateDepartment_DivisionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartment_DivisionRequest $request)
    {
        $departmentDivision = $this->departmentDivisionRepository->find($id);

        if (empty($departmentDivision)) {
            Flash::error('Department  Division not found');

            return redirect(route('admin.departmentDivisions.index'));
        }

        $departmentDivision = $this->departmentDivisionRepository->update($request->all(), $id);

        Flash::success('Department  Division updated successfully.');

        return redirect(route('admin.departmentDivisions.index'));
    }

    /**
     * Remove the specified Department_Division from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $departmentDivision = $this->departmentDivisionRepository->find($id);

        if (empty($departmentDivision)) {
            Flash::error('Department  Division not found');

            return redirect(route('admin.departmentDivisions.index'));
        }

        $this->departmentDivisionRepository->delete($id);

        Flash::success('Department  Division deleted successfully.');

        return redirect(route('admin.departmentDivisions.index'));
    }
}
