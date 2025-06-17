<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{

    /**
     * @var array
     */
    public static array $fetchOptions = [
        'table' => 'contact_messages',
        'defaultSort' => 'id',
        'allowedSelects' => '*',
        'allowedFilters' => [
            'id',
            'name',
            'email',
            'application_number',
            'read_at'
        ],
        'allowedSorts' => [
            'id',
            'name',
            'email',
            'read_at',
            'created_at'
        ],
        'allowedIncludes' => [
            'request',
        ],
    ];

    /**
     * @return BelongsTo
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(VisaRequest::class, 'application_number', 'id');
    }
}
