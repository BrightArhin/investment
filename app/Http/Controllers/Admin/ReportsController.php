<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use App\Models\Admin\Division;
use App\Models\Admin\Member;
use App\Models\Admin\Transaction;
use App\Repositories\Admin\MemberRepository;
use App\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //

    private $memberRepository;

    public function __construct(MemberRepository $memberRepo)
    {
       $this->memberRepository = $memberRepo;
    }

    public function member_statement(){

        return view('admin.reports.member_statement');
    }

    public function generate_statement(Request $request){

        try{
            $result = array();
            $from = date($request->from);
            $to = date($request->to);
            $member =  Member::where('staff_id', $request->staff_id)->first();
            if($member != null){
                $division = Division::findOrFail($member->division_id);
                $department = Department::findOrFail($member->department_id);
                $transaction = Transaction::where('member_id', $member->id)
                    ->whereRaw( "(transaction_date >= ? AND transaction_date <= ?)",
                        [$from." 00:00:00", $to." 23:59:59"])->get();
                $user = User::findOrFail($member->user_id);
                $result['member_details'] = $member;
                $result['transactions']= $transaction;
                $result['user']= $user;
                $result['division'] = $division;
                $result['department'] = $department;
                $result['from']= $request->from;
                $result['to']= $request->to;

                return response()->json(['message'=>$result]);
            }else{
                return response()->json(['error'=>'Member with staff ID of '.$request->staff_id.' not found']);
            }

        }catch (\Exception $e){
            return response()->json(['error'=>$e]);
        }

    }
}
