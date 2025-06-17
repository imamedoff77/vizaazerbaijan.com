<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    /**
     * @var array
     */
    public static array $fetchOptions = [
        'table' => 'services',
        'defaultSort' => 'id',
        'allowedSelects' => '*',
        'allowedFilters' => [
            'id',
        ],
        'allowedSorts' => [
            'id',
        ],
        'allowedIncludes' => [
        ],
    ];

    protected $casts = [
        'price' => 'double',
        'meta' => 'json',
    ];
}
