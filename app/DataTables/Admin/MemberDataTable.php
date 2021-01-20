<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Department;
use App\Models\Admin\Division;
use App\Models\Admin\Member;
use App\Repositories\Admin\UserRepository;
use App\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MemberDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */


    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'admin.members.datatables_actions')
            ->editColumn('user_id', function ($staff){
                /** @var Member|\stdClass $staff  */
                $user = User::findOrFail($staff->user_id);
                return  $user->name;
            })
            ->editColumn('department_id', function ($staff){
                /** @var Member|\stdClass $staff  */
                $department= Department::findOrFail($staff->department_id);
                return  $department->name;
            })->editColumn('division_id', function ($staff){
                /** @var Member|\stdClass $staff  */
                $division= Division::findOrFail($staff->division_id);
                return  $division->name;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin\Member $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Member $model)
    {

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'asc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {

        return [
//

            ['data' => 'user_id', 'name' => 'user_id', 'title' => 'Name'],
            ['data' => 'staff_id', 'name' => 'staff_id', 'title' => 'Staff_ID'],
            ['data' => 'department_id', 'name' => 'department_id', 'title' => 'Department'],
            ['data' => 'division_id', 'name' => 'division_id', 'title' => 'Division']
        ];


    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'members_datatable_' . time();
    }
}
