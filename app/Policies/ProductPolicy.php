<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
   // app/Policies/ProductPolicy.php

public function viewAny(User $user): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || $user->isShopowner();
}

public function view(User $user, Product $product): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || $user->isShopowner();
}

public function create(User $user): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || $user->isShopowner();
}

public function update(User $user, Product $product): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || ($user->isShopowner() && $product->shop_id == $user->id);
}

public function delete(User $user, Product $product): bool
{
    return $user->isAdmin() || $user->isSuperadmin() || ($user->isShopowner() && $product->shop_id == $user->id);
}

}
