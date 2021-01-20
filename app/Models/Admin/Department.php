<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Department
 * @package App\Models\Admin
 * @version December 3, 2020, 12:47 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $divisions
 * @property string $name
 * @property string $code
 */
class Department extends Model
{
    use SoftDeletes;

    public $table = 'departments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'code'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'code' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function divisions()
    {
        return $this->belongsToMany(\App\Models\Admin\Division::class, 'department_division', 'division_id', 'department_id');
    }
}
