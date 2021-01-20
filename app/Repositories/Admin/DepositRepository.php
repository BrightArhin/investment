<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Deposit;
use App\Repositories\BaseRepository;

/**
 * Class DepositRepository
 * @package App\Repositories\Admin
 * @version December 14, 2020, 6:18 am UTC
*/

class DepositRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'member_id',
        'deposit_date',
        'reference',
        'narration',
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
        return Deposit::class;
    }
}
