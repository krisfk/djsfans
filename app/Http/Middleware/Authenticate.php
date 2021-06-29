<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // echo 999;
            // $errors = ['erros' => trans('auth.failed')];

            // return response()->json($errors, 422);
            // return 9099;
            // return response()->json(['ddd'=>'aaa'], 422);

            return route('login');
            // return response()->json(['authorise error'=>], 422);
// 
            // return response()->json(['error'=>'Unauthorised'], 401);

            // return 999;
        }
    }
}