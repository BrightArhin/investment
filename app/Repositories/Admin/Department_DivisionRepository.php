<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Department_Division;
use App\Repositories\BaseRepository;

/**
 * Class Department_DivisionRepository
 * @package App\Repositories\Admin
 * @version December 3, 2020, 12:56 pm UTC
*/

class Department_DivisionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'department_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Department_Division::class;
    }
}
