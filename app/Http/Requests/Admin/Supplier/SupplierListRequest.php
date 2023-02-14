<?php
/*
 * Created Date: 13/02/2023, 21:05
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

class SupplierListRequest extends AdminRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}
