<?php

namespace App\Imports;

use App\Models\Admin\Deposit;
use App\Models\Admin\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class DespositsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Deposit
    */
    public function model(array $row)
    {
        $intdatevalue =$row[0];
        $deposit_date =  date('Y-m-d',strtotime('1899-12-31+'.($intdatevalue-1).' days'));

        $transaction_exist= Transaction::where('staff_id', $row[1])->first();
        if($transaction_exist != null){
            $transaction_latest = Transaction::where('staff_id', $row[1])->latest('id')->first();
            $transaction = Transaction::create([
                'staff_id'=>$row[1],
                'transaction_type'=>$row[4],
                'transaction_date'=>$deposit_date,
                'amount'=>$row[5],
                'balance'=> $transaction_latest->balance + $row[5]
            ]);

        }else{
            $transaction = Transaction::create([
                'staff_id'=>$row[1],
                'transaction_type'=>$row[4],
                'transaction_date'=>$deposit_date,
                'amount'=>$row[5],
                'balance'=> $row[5]
            ]);
        }
        $div_str = explode('-',$row[2]);
        return new Deposit([
            'deposit_date'=>$deposit_date,
            'staff_id'=>$row[1],
            'division_id'=>$div_str[1],
            'reference'=>$row[3],
            'description'=>$row[4],
            'transaction_id'=>$transaction->id,
            'amount'=>$row[5]

        ]);
    }
}
