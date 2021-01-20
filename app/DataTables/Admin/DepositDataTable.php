<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Deposit;
use App\Models\Admin\Division;
use App\Models\Admin\Member;
use App\User;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class DepositDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'admin.deposits.datatables_actions')
            ->editColumn('staff_id', function ($deposit){
                /** @var Deposit|\stdClass $deposit  */
                $member = Member::where('staff_id', $deposit->staff_id)->first();
                $user  = User::findOrFail($member->id);
                return $user->name;
            })
            ->editColumn('division_id', function ($deposit){
                /** @var Deposit|\stdClass $deposit  */
                $division = Division::find($deposit->division_id);
                return  $division->name;
            })
            ->editColumn('deposit_date', function ($deposit){
                /** @var Deposit|\stdClass $deposit  */
                return  Carbon::parse( $deposit->deposit_date)->isoFormat('MMMM, DD YYYY');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Deposit $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Deposit $model)
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
            ['data' => 'deposit_date', 'name' => 'deposit_date', 'title' => 'Deposit Date'],
            ['data' => 'staff_id', 'name' => 'staff_id', 'title' => 'Member'],
            ['data' => 'division_id', 'name' => 'division_id', 'title' => 'Division'],
            ['data' => 'reference', 'name' => 'reference', 'title' => 'Reference'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],

        ];



    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'deposits_datatable_' . time();
    }
}
