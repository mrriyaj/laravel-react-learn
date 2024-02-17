<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    // app/Policies/CategoryPolicy.php

public function viewAny(User $user): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || $user->isShopowner();
}

public function view(User $user, Category $category): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || $user->isShopowner();
}

public function create(User $user): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || $user->isShopowner();
}

public function update(User $user, Category $category): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || ($user->isShopowner() && $category->shop_id == $user->id);
}

public function delete(User $user, Category $category): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || ($user->isShopowner() && $category->shop_id == $user->id);
}

}
