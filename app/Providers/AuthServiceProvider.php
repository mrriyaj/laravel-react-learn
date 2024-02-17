<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Policies\BrandPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Brand::class => BrandPolicy::class,
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define additional gates or before hooks if needed
        $this->defineBrandPolicies();
        $this->defineCategoryPolicies();
        $this->defineProductPolicies();
        $this->defineUserPolicies();
    }

    /**
     * Define category-related policies.
     */
    private function defineBrandPolicies(): void
    {
        Gate::define('create_brand', [BrandPolicy::class, 'create']);
        Gate::define('update_brand', [BrandPolicy::class, 'update']);
        Gate::define('delete_brand', [BrandPolicy::class, 'delete']);
        Gate::define('view_brand', [BrandPolicy::class, 'view']);
        Gate::define('view_any_brand', [BrandPolicy::class, 'viewAny']);
    }

    /**
     * Define category-related policies.
     */
    private function defineCategoryPolicies(): void
    {
        Gate::define('create_category', [CategoryPolicy::class, 'create']);
        Gate::define('update_category', [CategoryPolicy::class, 'update']);
        Gate::define('delete_category', [CategoryPolicy::class, 'delete']);
        Gate::define('view_category', [CategoryPolicy::class, 'view']);
        Gate::define('view_any_category', [CategoryPolicy::class, 'viewAny']);
    }

    /**
     * Define product-related policies.
     */
    private function defineProductPolicies(): void
    {
        Gate::define('create_product', [ProductPolicy::class, 'create']);
        Gate::define('update_product', [ProductPolicy::class, 'update']);
        Gate::define('delete_product', [ProductPolicy::class, 'delete']);
        Gate::define('view_product', [ProductPolicy::class, 'view']);
        Gate::define('view_any_product', [ProductPolicy::class, 'viewAny']);
    }

    /**
     * Define user-related policies.
     */
    private function defineUserPolicies(): void
    {
        Gate::define('create_user', [UserPolicy::class, 'create']);
        Gate::define('update_user', [UserPolicy::class, 'update']);
        Gate::define('delete_user', [UserPolicy::class, 'delete']);
        Gate::define('view_user', [UserPolicy::class, 'view']);
        Gate::define('view_any_user', [UserPolicy::class, 'viewAny']);
    }
}
