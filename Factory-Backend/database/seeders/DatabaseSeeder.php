<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            CountriesTableSeeder::class,
            GlobalSettingTableSeeder::class,
            ImageTableSeeder::class,
            NoticeBoardTableSeeder::class,
            ItemCategoryTableSeeder::class,
            ItemTableSeeder::class,
            StockOutTableSeeder::class,
            StockInTableSeeder::class,
            AdjustTableSeeder::class,
        ]);
    }
}
