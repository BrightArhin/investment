<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Division;
use App\Repositories\BaseRepository;

/**
 * Class DivisionRepository
 * @package App\Repositories\Admin
 * @version December 3, 2020, 12:45 pm UTC
*/

class DivisionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'unique_code'
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
        return Division::class;
    }
}
