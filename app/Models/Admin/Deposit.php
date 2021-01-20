<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Deposit
 * @package App\Models\Admin
 * @version December 14, 2020, 6:18 am UTC
 *
 * @property integer $member_id
 * @property string $deposit_date
 * @property string $reference
 * @property string $narration
 * @property number $amount
 * @property integer $transaction_id
 */
class Deposit extends Model
{
    use SoftDeletes;

    public $table = 'deposits';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'staff_id',
        'deposit_date',
        'reference',
        'description',
        'division_id',
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
        'deposit_date' => 'datetime',
        'reference' => 'string',
        'narration' => 'string',
        'amount' => 'double',
        'division_id'=>'integer',
        'transaction_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'member_id' => 'required'
    ];

    public function transaction(){
        return $this->belongsTo('App\Models\Admin\Transaction', 'transaction_id', 'id');
    }

}
