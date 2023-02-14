<?php
/*
 * Created Date: 13/02/2023, 21:11
 * Author: Đức Thuấn
 * Email: thuan.td@proteanstudios.com
 * ------------------------------------------------------------------
 * Last Modified:
 * Modified By:
 * ------------------------------------------------------------------
 * Copyright (c) 2023 PROS+ Group , Inc
 * ------------------------------------------------------------------
 */

namespace App\Http\Resource\Admin\Supplier;

use App\Http\Resource\Admin\BaseCollection;

class SupplierCollection extends BaseCollection
{
    public function toArray($request)
    {
        return array_merge([
            'data' => SupplierResource::collection($this->collection)
        ], parent::toArray($request));
    }
}
