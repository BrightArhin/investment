<?php

namespace App\Http\Controllers\Exporting;

use App\Http\Controllers\AppBaseController;
use Maatwebsite\Excel\Excel;
use App\Exports\UserExport;

class UserExportsController extends AppBaseController {

    private $excel;
    public function __construct(Excel $excel)
    {
      $this->excel = $excel;
    }

    public function export(){
       return $this->excel->download(new UserExport, 'users.xlsx');
    }
    public function  getForm(){
        return view('export.test_export');
    }

}
