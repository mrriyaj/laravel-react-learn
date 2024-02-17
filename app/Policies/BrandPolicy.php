<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BrandPolicy
{
    // app/Policies/BrandPolicy.php

public function viewAny(User $user): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || $user->isShopowner();
}

public function view(User $user, Brand $brand): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || $user->isShopowner();
}

public function create(User $user): bool
{
    return $user->isAdmin() || $user->isSuperadmin();
}

public function update(User $user, Brand $brand): bool
{
    return $user->isAdmin() || $user->isSuperadmin();
}

public function delete(User $user, Brand $brand): bool
{
    return $user->isAdmin() || $user->isSuperadmin();
}

}
