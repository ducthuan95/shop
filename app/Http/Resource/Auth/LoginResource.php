<?php
/*
 * Created Date: 13/02/2023, 11:29
 * Author: Đức Thuấn
 * Email: thuan.td@proteanstudios.com
 * ------------------------------------------------------------------
 * Last Modified:
 * Modified By:
 * ------------------------------------------------------------------
 * Copyright (c) 2023 PROS+ Group , Inc
 * ------------------------------------------------------------------
 */

namespace App\Http\Resource\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'token' => $this->createToken($this->role->name, ['server:admin'])->plainTextToken,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'avatar' => $this->avatar,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'role' => $this->role->name,
            'role_description' => $this->role->description,
            'supplier_name' => $this->supplier->name,
            'supplier_address' => $this->supplier->address,
        ];
    }
}
