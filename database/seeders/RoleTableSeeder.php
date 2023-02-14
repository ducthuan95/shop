<?php
/*
 * Created Date: 10/02/2023, 14:58
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

Class RoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->upsert(
            [
                [
                    'name'        => 'super_admin',
                    'description' => 'super admin role',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'        => 'admin',
                    'description' => 'admin role',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'        => 'user',
                    'description' => 'user role',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'        => 'supplier',
                    'description' => 'supplier role',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
            ],
            ['name'],
            ['name', 'description', 'updated_at']
        );
    }
}
