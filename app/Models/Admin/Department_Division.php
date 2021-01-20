<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Department_Division
 * @package App\Models\Admin
 * @version December 3, 2020, 12:56 pm UTC
 *
 * @property integer $department_id
 */
class Department_Division extends Model
{
    use SoftDeletes;

    public $table = 'department__divisions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'department_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'department_id' => 'integer',
        'division_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'department_id' => 'required',
        'division_id' => 'required'
    ];

    
}
