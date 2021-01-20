<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Loan;
use App\Repositories\BaseRepository;

/**
 * Class LoanRepository
 * @package App\Repositories\Admin
 * @version December 14, 2020, 6:28 am UTC
*/

class LoanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'member_id',
        'loan_date',
        'amount',
        'interest_rate',
        'interest_acc_date',
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
        return Loan::class;
    }
}
