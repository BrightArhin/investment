<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Withdrawal
 * @package App\Models\Admin
 * @version December 14, 2020, 6:22 am UTC
 *
 * @property integer $member_id
 * @property string $withdrawal_date
 * @property string $reference
 * @property number $amount
 * @property integer $transaction_id
 */
class Withdrawal extends Model
{
    use SoftDeletes;

    public $table = 'withdrawals';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'staff_id',
        'withdrawal_date',
        'division_id',
        'reference',
        'description',
        'amount',
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
        'withdrawal_date' => 'datetime',
        'description'=>'string',
        'division_id'=>'integer',
        'reference' => 'string',
        'amount' => 'double',
        'transaction_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'member_id'=> 'required'
    ];

    public function transaction(){
        return $this->belongsTo('App\Models\Admin\Transaction', 'transaction_id', 'id');
    }


}
