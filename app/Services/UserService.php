<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Regras de negócio e persistência de usuários. A senha é criptografada
 * automaticamente pelo cast "hashed" definido no model User.
 */
class UserService
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return User::orderBy('name')->paginate($perPage);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Atualiza o usuário. Quando a senha vier vazia, mantém a senha atual.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(User $user, array $data): User
    {
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
