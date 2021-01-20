<?php

namespace App\Models\Admin;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Member
 * @package App\Models\Admin
 * @version December 3, 2020, 1:25 pm UTC
 *
 * @property \App\Models\Admin\User $user
 * @property \App\Models\Admin\Department $department
 * @property \App\Models\Admin\Division $division
 * @property integer $user_id
 * @property integer $staff_id
 * @property string $member_id
 * @property integer $department_id
 * @property integer $division_id
 */
class Member extends Eloquent
{
    use SoftDeletes;

    public $table = 'staffs';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'staff_id',
        'department_id',
        'division_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'staff_id' => 'integer',
        'department_id' => 'integer',
        'division_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'staff_id' => 'required',
        'department_id' => 'required',
        'division_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function department()
    {
        return $this->hasOne(\App\Models\Admin\Department::class, 'department_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function division()
    {
        return $this->hasOne(\App\Models\Admin\Division::class, 'division_id', 'id');
    }
}
