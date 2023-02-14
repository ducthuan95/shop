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

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends AdminRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'parent_id' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'numeric|required',
        ];
    }
}
