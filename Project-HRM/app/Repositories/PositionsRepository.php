<?php

namespace App\Repositories;

use App\Models\Positions;
use App\Repositories\BaseRepository;

/**
 * Class PositionsRepository
 * @package App\Repositories
 * @version January 18, 2021, 10:02 am UTC
 */
class PositionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code',
        'description'
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
        return Positions::class;
    }

//    public function create($input)
//    {
//        return Positions ::create($input);
//    }
}
