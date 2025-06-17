<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * @var array
     */
    public static array $fetchOptions = [
        'table' => 'countries',
        'defaultSort' => 'id',
        'allowedSelects' => '*',
        'allowedFilters' => [
            'id',
        ],
        'allowedSorts' => [
            'id',
            'name',
        ],
        'allowedIncludes' => [
        ],
    ];

}
