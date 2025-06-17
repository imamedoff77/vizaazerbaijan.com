<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    /**
     * @var array
     */
    public static array $fetchOptions = [
        'table' => 'users',
        'allowedSelects' => '*',
        'defaultSort' => 'id',
        'auth' => true,
        'onlyAuthor' => [
            'column' => 'id'
        ],
        'allowedFilters' => [
            'id',
            'name',
            'surname',
            'email',
            'role'
        ],
        'allowedSorts' => [
            'id',
            'name',
            'email',
            'created_at',
            'role'
        ],
        'allowedIncludes' => [
        ],
    ];

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->status === 'super';
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->status === 'simple';
    }
}
