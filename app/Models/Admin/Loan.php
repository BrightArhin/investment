<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Loan
 * @package App\Models\Admin
 * @version December 14, 2020, 6:28 am UTC
 *
 * @property integer $member_id
 * @property string $loan_date
 * @property number $amount
 * @property number $interest_rate
 * @property string $interest_acc_date
 * @property integer $transaction_id
 */
class Loan extends Model
{
    use SoftDeletes;

    public $table = 'loans';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'member_id',
        'loan_date',
        'amount',
        'interest_rate',
        'interest_acc_date',
        'transaction_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'member_id' => 'integer',
        'loan_date' => 'datetime',
        'amount' => 'double',
        'interest_rate' => 'double',
        'interest_acc_date' => 'datetime',
        'transaction_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'member_id' => 'required',
        'loan_date' => 'required'
    ];

    public function transaction(){
        return $this->belongsTo('App\Models\Admin\Transaction', 'transaction_id', 'id');
    }

}
