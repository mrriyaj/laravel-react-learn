<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    // app/Policies/UserPolicy.php

public function viewAny(User $user): bool
{
    return $user->isAdmin() || $user->isSuperadmin();
}

public function view(User $user, User $targetUser): bool
{
    return $user->isAdmin() || $user->isSuperadmin();
}

public function update(User $user, User $targetUser): bool
    {
        // Users cannot update their own roles
        if ($user->id === $targetUser->id) {
            return false;
        }

        // Admins can update roles, but not to 'super_admin'
        if ($user->isAdmin() && !$targetUser->isSuperadmin()) {
            return true;
        }

        // Super admin has no restrictions
        return $user->isSuperadmin();
    }

public function delete(User $user, User $targetUser): bool
{
    return $user->isAdmin() || $user->isSuperadmin();
}

}
