<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Division
 * @package App\Models\Admin
 * @version December 3, 2020, 12:45 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $departments
 * @property string $name
 * @property string $unique_code
 */
class Division extends Model
{
    use SoftDeletes;

    public $table = 'divisions';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'unique_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'unique_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'unique_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function departments()
    {
        return $this->belongsToMany(\App\Models\Admin\Department::class, 'department_division', 'department_id', 'divsion_id');
    }
}
