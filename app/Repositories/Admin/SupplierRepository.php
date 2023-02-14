<?php
/*
 * Created Date: 13/02/2023, 21:00
 * Author: Đức Thuấn
 * Email: thuan.td@proteanstudios.com
 * ------------------------------------------------------------------
 * Last Modified:
 * Modified By:
 * ------------------------------------------------------------------
 * Copyright (c) 2023 PROS+ Group , Inc
 * ------------------------------------------------------------------
 */

namespace App\Repositories\Admin;

use App\Models\Supplier;
use App\Repositories\BaseRepository;

class SupplierRepository extends BaseRepository
{
    public function __construct(Supplier $supplier)
    {
        $this->setModel($supplier);
    }
}
