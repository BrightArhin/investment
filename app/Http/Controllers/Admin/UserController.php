<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DepositDataTable;
use App\DataTables\Admin\UserDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateDepositRequest;
use App\Http\Requests\Admin\UpdateDepositRequest;
use App\Imports\UsersImport;
use App\Repositories\Admin\DepositRepository;
use App\Repositories\Admin\UserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class UserController extends AppBaseController
{
    /** @var  DepositRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the Deposit.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new Deposit.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created Deposit in storage.
     *
     * @param CreateDepositRequest $request
     *
     * @return Response
     */
    public function store(Admin\CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('admin.users.index'));
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
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        return view('admin.users.show')->with('user', $user);
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
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        return view('admin.users.edit')->with('user', $user);
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
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('admin.users.index'));
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
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('admin.users.index'));
    }

    public function import(){
        Excel::import(new UsersImport(), '/users.xls');
        return redirect('/')->with('success', 'All good!');
    }
}
