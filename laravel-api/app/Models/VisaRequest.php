<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VisaRequest extends Model
{

    /**
     * @var array
     */
    public static array $fetchOptions = [
        'table' => 'visa_requests',
        'defaultSort' => 'id',
        'allowedSelects' => '*',
        'allowedFilters' => [
            'id',
            'status',
            'given_name',
            'email',
            'application_number'
        ],
        'allowedSorts' => [
            'id',
            'application_number',
            'created_at'
        ],
        'allowedIncludes' => [
            'service',
            'rejected'
        ],
    ];


    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return HasOne
     */
    public function rejected(): HasOne
    {
        return $this->hasOne(VisaReject::class, 'visa_id');
    }
}
