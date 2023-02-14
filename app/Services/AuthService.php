<?php
/*
 * Created Date: 10/02/2023, 15:15
 * Author: Đức Thuấn
 * Email: thuan.td@proteanstudios.com
 * ------------------------------------------------------------------
 * Last Modified:
 * Modified By:
 * ------------------------------------------------------------------
 * Copyright (c) 2023 PROS+ Group , Inc
 * ------------------------------------------------------------------
 */

namespace App\Services;

use App\Exceptions\AuthenticationException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Crypt;

class AuthService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($params)
    {
        $user = $this->userRepository->firstWith(['email' => $params['email']], ['*'], ['role', 'supplier']);

        if (!$user || Crypt::decryptString($user['password']) != $params['password']) {
            throw new AuthenticationException();
        }

        return $user;
    }
}
