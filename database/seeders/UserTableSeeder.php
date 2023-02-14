<?php
/*
 * Created Date: 10/02/2023, 15:06
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

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@system.mail',
            'password' => 'eyJpdiI6IkpGR0Z2Z3ZCZXBad2YvcmtOb3hZK0E9PSIsInZhbHVlIjoiSVVKL3RNQ0k4YndvQUR6MTdYUEZkQT09IiwibWFjIjoiNTBjMThkNGQ0MjIyNzZiY2FkOGUyZWYxMDY2ODI1Y2YzM2Y2ZjFkYjliNDUyNDllMmViYWRjMWYwZTA0YzllMiIsInRhZyI6IiJ9', //123123
            'role_id' => 1,
            'supplier_id' => 1,
            'status' => 9,
            'address' => "HN",
        ]);


    }
}
