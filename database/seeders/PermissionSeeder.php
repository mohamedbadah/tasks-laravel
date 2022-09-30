<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(["name"=>"read_category","guard_name"=>"user"]);
        Permission::create(["name"=>"delete_category","guard_name"=>"user"]);
        Permission::create(["name"=>"edit_category","guard_name"=>"user"]);
        Permission::create(["name"=>"read_post","guard_name"=>"user"]);
        Permission::create(["name"=>"edit_post","guard_name"=>"user"]);
        Permission::create(["name"=>"delete_post","guard_name"=>"user"]);
    }
}
