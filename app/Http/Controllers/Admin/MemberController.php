<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MemberDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateMemberRequest;
use App\Http\Requests\Admin\UpdateMemberRequest;
use App\Repositories\Admin\MemberRepository;
use App\Repositories\Admin\UserRepository;
use App\Repositories\Admin\DepartmentRepository;
use App\Repositories\Admin\DivisionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MemberController extends AppBaseController
{
    /** @var  MemberRepository */
    private $memberRepository;
    private $userRepository;
    private $divisionRepository;
    private $departmentRepository;

    public function __construct(
        MemberRepository $memberRepo,
        UserRepository $userRepo,
        DivisionRepository $divisionRepo,
        DepartmentRepository $deptRepo)
    {
        $this->memberRepository = $memberRepo;
        $this->userRepository = $userRepo;
        $this->departmentRepository = $deptRepo;
        $this->divisionRepository = $divisionRepo;
    }

    /**
     * Display a listing of the Member.
     *
     * @param MemberDataTable $memberDataTable
     * @return Response
     */
    public function index(MemberDataTable $memberDataTable)
    {
        return $memberDataTable->render('admin.members.index');
    }

    /**
     * Show the form for creating a new Member.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = $this->userRepository->all()->pluck('name', 'id');
        $divisions = $this->divisionRepository->all()->pluck('name', 'id') ;
        $departments = $this->departmentRepository->all()->pluck('name', 'id') ;
        return view('admin.members.create', compact(['users', 'divisions', 'departments']));
    }

    /**
     * Store a newly created Member in storage.
     *
     * @param CreateMemberRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberRequest $request)
    {
        $input = $request->all();

        $member = $this->memberRepository->create($input);

        Flash::success('Member saved successfully.');

        return redirect(route('admin.members.index'));
    }

    /**
     * Display the specified Member.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('admin.members.index'));
        }

        return view('admin.members.show')->with('member', $member);
    }

    /**
     * Show the form for editing the specified Member.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('admin.members.index'));
        }

        return view('admin.members.edit')->with('member', $member);
    }

    /**
     * Update the specified Member in storage.
     *
     * @param  int              $id
     * @param UpdateMemberRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberRequest $request)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('admin.members.index'));
        }

        $member = $this->memberRepository->update($request->all(), $id);

        Flash::success('Member updated successfully.');

        return redirect(route('admin.members.index'));
    }

    /**
     * Remove the specified Member from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('admin.members.index'));
        }

        $this->memberRepository->delete($id);

        Flash::success('Member deleted successfully.');

        return redirect(route('admin.members.index'));
    }
}
