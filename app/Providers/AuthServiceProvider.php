<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-item',function($user,$item){
        //     return $user->id == $item->user_id;
        // });
        // Gate::define('delete-item',function($user,$item){
        //     return $user->id == $item->user_id;
        // });
        Gate::define('create-item',function($user){
            return $user->is_admin;
        });

        Gate::define('items.update','App\Policies\ItemPolicy@update');
        Gate::define('items.delete','App\Policies\ItemPolicy@delete');
        Gate::resource('posts','App\Policies\ItemPolicy');
        
        // Gate::before(function($user,$ability){
        //     if($user->is_admin && in_array($ability,['items.update']))
        //         {
        //             return true;
        //         }
        // });
    }
}
