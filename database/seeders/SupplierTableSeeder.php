<?php
/*
 * Created Date: 13/02/2023, 19:28
 * Author: Đức Thuấn
 * Email: thuan.td@proteanstudios.com
 * ------------------------------------------------------------------
 * Last Modified:
 * Modified By:
 * ------------------------------------------------------------------
 * Copyright (c) 2023 PROS+ Group , Inc
 * ------------------------------------------------------------------
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('suppliers')->insert([
            'category_id' => 1,
            'name' => 1,
            'email' => 1,
            'address' => 1,
            'status' => 1,
        ]);
    }
}
