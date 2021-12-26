<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class Decentralization extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        $adminRoles = Roles::where('role_name', 'admin')->first();
        $authorRoles = Roles::where('role_name', 'author')->first();

        $admin = Admin::create([
            'admin_name' => 'Demaon',
            'admin_email' => 'demaon@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => '123456'
        ]);

        $author = Admin::create([
            'admin_name' => 'Đức Anh',
            'admin_email' => 'demaon2010@gmail.com',
            'admin_phone' => '0934534543',
            'admin_password' => '123456'
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
    }
}
