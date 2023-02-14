<?php
/*
 * Created Date: 10/02/2023, 15:11
 * Author: Đức Thuấn
 * Email: thuan.td@proteanstudios.com
 * ------------------------------------------------------------------
 * Last Modified:
 * Modified By:
 * ------------------------------------------------------------------
 * Copyright (c) 2023 PROS+ Group , Inc
 * ------------------------------------------------------------------
 */

namespace App\Http\Controllers\Auth;

use App\Exceptions\AuthenticationException;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resource\Auth\LoginResource;
use App\Services\AuthService;

class LoginController extends BaseController
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request)
    {
        $params = $request->dataValidated();

        return $this->getData(function () use ($params){
           return new LoginResource($this->authService->login($params));
        });
    }
}
