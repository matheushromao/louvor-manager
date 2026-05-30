<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public const ROLE_USER = 'user';
    public const ROLE_VOCAL = 'vocal';
    public const ROLE_ADMIN = 'admin';
    public const ROLES = [self::ROLE_USER, self::ROLE_VOCAL, self::ROLE_ADMIN];

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

    public function isVocal(): bool
    {
        return $this->role === self::ROLE_VOCAL;
    }

    /**
     * Rota inicial conforme a role: admins vão ao dashboard,
     * os demais (vocal/user) vão para os repertórios.
     */
    public function homeRoute(): string
    {
        return $this->isAdmin() ? 'dashboard' : 'repertorios.index';
    }

    /**
     * Admins e vocais podem gerenciar (criar/editar/excluir) escalas.
     */
    public function canManageEscala(): bool
    {
        return $this->isAdmin() || $this->isVocal();
    }

    /**
     * Escalas em que o usuário foi escalado para cantar.
     */
    public function escalas(): BelongsToMany
    {
        return $this->belongsToMany(Escala::class);
    }
}
