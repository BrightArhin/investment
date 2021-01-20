<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 * @package App\Models\Admin
 * @version December 14, 2020, 5:54 am UTC
 *
 * @property \App\Models\Admin\Deposit $deposit
 * @property \App\Models\Admin\Withdrawal $withdrawal
 * @property \App\Models\Admin\Loan $loan
 * @property \App\Models\Admin\Interest $interest
 * @property integer $member_id
 * @property string $transaction_type
 * @property number $amount
 */
class Transaction extends Model
{
    use SoftDeletes;

    public $table = 'transactions';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'staff_id',
        'transaction_type',
        'transaction_date',
        'amount',
        'balance'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'member_id' => 'integer',
        'transaction_type' => 'string',
        'amount' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'member_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function deposit()
    {
        return $this->hasOne(\App\Models\Admin\Deposit::class, 'transaction_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function withdrawal()
    {
        return $this->hasOne(\App\Models\Admin\Withdrawal::class, 'transaction_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function loan()
    {
        return $this->hasOne(\App\Models\Admin\Loan::class, 'transaction_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function interest()
    {
        return $this->hasOne(\App\Models\Admin\Interest::class, 'transaction_id', 'id');
    }
}
