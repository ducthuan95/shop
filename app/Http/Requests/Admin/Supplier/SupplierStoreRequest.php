<?php
/*
 * Created Date: 13/02/2023, 21:16
 * Author: Đức Thuấn
 * Email: thuan.td@proteanstudios.com
 * ------------------------------------------------------------------
 * Last Modified:
 * Modified By:
 * ------------------------------------------------------------------
 * Copyright (c) 2023 PROS+ Group , Inc
 * ------------------------------------------------------------------
 */

namespace App\Http\Requests\Admin\Supplier;

use App\Http\Requests\Admin\AdminRequest;

class SupplierStoreRequest extends AdminRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email|unique:suppliers,email',
            'address' => 'required|string',
            'avatar' => 'file|nullable',
        ];
    }
}
