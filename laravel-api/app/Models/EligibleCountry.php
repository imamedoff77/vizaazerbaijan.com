<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EligibleCountry extends Model
{
    /**
     * @var array
     */
    public static array $fetchOptions = [
        'table' => 'eligible_countries',
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
