<?php

namespace App\Imports;


use App\Models\Admin\Transaction;
use App\Models\Admin\Withdrawal;
use Maatwebsite\Excel\Concerns\ToModel;

class WithdrawalsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Withdrawal
    */

    public function model(array $row)
    {
        $excel_date =$row[0];
        $withdrawal_date =  date('Y-m-d',strtotime('1899-12-31+'.($excel_date-1).' days'));


            $transaction_latest = Transaction::where('staff_id', $row[1])->latest('id')->first();
            $transaction = Transaction::create([
                'staff_id'=>$row[1],
                'transaction_type'=>$row[4],
                'transaction_date'=>$withdrawal_date,
                'amount'=>$row[5],
                'balance'=> $transaction_latest->balance - $row[5]
            ]);


        $div_str = explode('-',$row[2]);
        return new Withdrawal([
            'withdrawal_date'=>$withdrawal_date,
            'staff_id'=>$row[1],
            'division_id'=>$div_str[1],
            'reference'=>$row[3],
            'description'=>$row[4],
            'transaction_id'=>$transaction->id,
            'amount'=>$row[5]

        ]);
    }
}
