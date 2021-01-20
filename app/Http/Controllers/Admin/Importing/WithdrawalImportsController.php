<?php

namespace App\Http\Controllers\Admin\Importing;

use App\Http\Controllers\AppBaseController;
use App\Imports\DespositsImport;
use App\Imports\UsersImport;
use App\Imports\WithdrawalsImport;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use \Maatwebsite\Excel\Facades\Excel;

class WithdrawalImportsController extends AppBaseController {

    private $excel;
    public function __construct(Excel $excel)
    {
      $this->excel = $excel;
    }

//    public function  show(){
//        return view('imports.users');
//    }

    public function store(Request $request){
        $file = $request->file('excel_file');

        Excel::import(new WithdrawalsImport(),$file );
        Flash::success('Excel file imported successfully.');

        return redirect(route('admin.withdrawals.index'));
    }


}
