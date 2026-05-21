<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';
    public const ROLES = [self::ROLE_USER, self::ROLE_ADMIN];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public static function roles(): array
    {
        return self::ROLES;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
}
