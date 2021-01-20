<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;
use App\User;

/**
 * Class DepositRepository
 * @package App\Repositories\Admin
 * @version December 4, 2020, 10:54 am UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email'
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
        return User::class;
    }
}
