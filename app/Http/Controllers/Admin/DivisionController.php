<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DivisionDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateDivisionRequest;
use App\Http\Requests\Admin\UpdateDivisionRequest;
use App\Repositories\Admin\DivisionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DivisionController extends AppBaseController
{
    /** @var  DivisionRepository */
    private $divisionRepository;

    public function __construct(DivisionRepository $divisionRepo)
    {
        $this->divisionRepository = $divisionRepo;
    }

    /**
     * Display a listing of the Division.
     *
     * @param DivisionDataTable $divisionDataTable
     * @return Response
     */
    public function index(DivisionDataTable $divisionDataTable)
    {
        return $divisionDataTable->render('admin.divisions.index');
    }

    /**
     * Show the form for creating a new Division.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.divisions.create');
    }

    /**
     * Store a newly created Division in storage.
     *
     * @param CreateDivisionRequest $request
     *
     * @return Response
     */
    public function store(CreateDivisionRequest $request)
    {
        $input = $request->all();

        $division = $this->divisionRepository->create($input);

        Flash::success('Division saved successfully.');

        return redirect(route('admin.divisions.index'));
    }

    /**
     * Display the specified Division.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            Flash::error('Division not found');

            return redirect(route('admin.divisions.index'));
        }

        return view('admin.divisions.show')->with('division', $division);
    }

    /**
     * Show the form for editing the specified Division.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            Flash::error('Division not found');

            return redirect(route('admin.divisions.index'));
        }

        return view('admin.divisions.edit')->with('division', $division);
    }

    /**
     * Update the specified Division in storage.
     *
     * @param  int              $id
     * @param UpdateDivisionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDivisionRequest $request)
    {
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            Flash::error('Division not found');

            return redirect(route('admin.divisions.index'));
        }

        $division = $this->divisionRepository->update($request->all(), $id);

        Flash::success('Division updated successfully.');

        return redirect(route('admin.divisions.index'));
    }

    /**
     * Remove the specified Division from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            Flash::error('Division not found');

            return redirect(route('admin.divisions.index'));
        }

        $this->divisionRepository->delete($id);

        Flash::success('Division deleted successfully.');

        return redirect(route('admin.divisions.index'));
    }
}
