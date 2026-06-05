<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Apenas administradores gerenciam usuários.
     */
    public function manage(User $authUser): bool
    {
        return $authUser->isAdmin();
    }

    /**
     * Um administrador pode excluir outros usuários, mas nunca a si mesmo.
     */
    public function delete(User $authUser, User $target): bool
    {
        return $authUser->isAdmin() && $authUser->id !== $target->id;
    }
}
