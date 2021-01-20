<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Deposit;
use App\Models\Admin\Division;
use App\Models\Admin\Member;
use App\Models\Admin\Withdrawal;
use App\User;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class WithdrawalDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'admin.withdrawals.datatables_actions')
            ->editColumn('staff_id', function ($withdrawal){
                /** @var Deposit|\stdClass $deposit  */
                $member = Member::where('staff_id', $withdrawal->staff_id)->first();
                $user = User::findOrFail($member->user_id);
                return  $user->name;
            })
            ->editColumn('division_id', function ($withdrawal){
                /** @var Withdrawal|\stdClass $withdrawal  */
                $division = Division::findOrFail($withdrawal->division_id);
                return  $division->name;
            })
            ->editColumn('withdrawal_date', function ($withdrawal){
                /** @var Deposit|\stdClass $deposit  */
                return  Carbon::parse( $withdrawal->withdrawal_date)->isoFormat('MMMM, DD YYYY');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Withdrawal $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Withdrawal $model)
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
            ['data' => 'withdrawal_date', 'name' => 'withdrawal_date', 'title' => 'Withdrawal Date'],
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
        return 'withdrawals_datatable_' . time();
    }
}
