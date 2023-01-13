<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {

        $this->app['auth']->viaRequest('api', function ($request) {
                $token = $request->input('access_token');
                $key   =env('Access_Token');
                try{
                    $decoded = JWT::decode($token, new Key($key, 'HS256'));
                    return new User();
                }
                catch(\Exception $e){
                    return Null;
                }

        });
    }
}
