<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Deposit;
use App\Models\Admin\Member;
use App\Models\Admin\Transaction;
use App\User;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TransactionDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'admin.transactions.datatables_actions')
            ->editColumn('staff_id', function ($transaction){
                /** @var Transaction|\stdClass $transaction  */
                $member = Member::where('staff_id', $transaction->staff_id)->first();
                $user = User::findOrFail($member->user_id);
                return  $user->name;
            })->editColumn('transaction_date', function ($transaction){
                /** @var Deposit|\stdClass $deposit  */
                return  Carbon::parse($transaction->transaction_date)->isoFormat('MMMM, DD YYYY');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
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
                'order'     => [[0, 'desc']],
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

            ['data' => 'staff_id', 'name' => 'staff_id', 'title' => 'Member'],
            ['data' => 'transaction_type', 'name' => 'transaction_type', 'title' => 'Transaction Type'],
            ['data' => 'transaction_date', 'name' => 'transaction_date', 'title' => 'Transaction Date'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],
            ['data' => 'balance', 'name' => 'balance', 'title' => 'Balance']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'transactions_datatable_' . time();
    }
}
