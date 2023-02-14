<?php
/*
 * Created Date: 13/02/2023, 21:30
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
use Illuminate\Validation\Rule;

class SupplierUpdateRequest extends AdminRequest
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
            'address' => 'required|string',
            'avatar' => 'file|nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('suppliers')->ignore($this->id)
            ]
        ];
    }
}
