<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Withdrawal;
use App\Repositories\BaseRepository;

/**
 * Class WithdrawalRepository
 * @package App\Repositories\Admin
 * @version December 14, 2020, 6:22 am UTC
*/

class WithdrawalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'member_id',
        'withdrawal_date',
        'reference',
        'amount',
        'transaction_id'
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
        return Withdrawal::class;
    }
}
