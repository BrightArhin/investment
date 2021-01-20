<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Member;
use App\Repositories\BaseRepository;

/**
 * Class MemberRepository
 * @package App\Repositories\Admin
 * @version December 3, 2020, 1:25 pm UTC
*/

class MemberRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'staff_id',
        'member_id',
        'department_id',
        'division_id'
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
        return Member::class;
    }
}
