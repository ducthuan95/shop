<?php

namespace App\Http\Middleware;

use App\Exceptions\ServerException;
use Closure;
use App\Exceptions\AuthorizationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin extends Middleware
{
    /**
     * @param         $request
     * @param Closure $next
     * @param         ...$guards
     *
     * @return mixed
     * @throws AuthorizationException
     * @throws ServerException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $user = Auth::user();

            if (!$user->tokenCan('server:admin')) {
                throw new AuthorizationException();
            }

            return $next($request);
        } catch (AuthorizationException $e) {
            throw new AuthorizationException($e);
        } catch (\Exception $e) {
            throw new ServerException();
        }
    }
}
