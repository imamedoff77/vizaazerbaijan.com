<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    /**
     * @var array
     */
    public static array $fetchOptions = [
        'table' => 'pages',
        'defaultSort' => 'id',
        'allowedSelects' => '*',
        'allowedFilters' => [
            'id',
            'list_title',
            'page_title',
            'created_at'
        ],
        'allowedSorts' => [
            'id',
            'list_title',
            'views',
            'created_at',
        ],
        'allowedIncludes' => [
        ],
    ];


    protected $casts = [
        'keywords' => 'array',
        'block1' => 'array',
        'block2' => 'array',
    ];
}
