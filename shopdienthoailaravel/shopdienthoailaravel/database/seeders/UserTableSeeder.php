<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        
        $adminRoles = Roles::where('name','admin')->first();
        $staffRoles = Roles::where('name','staff')->first();


        $admin = Admin::create([
            'admin_name' => 'hoc nguyen',
            'admin_email' => 'vinhhoc72@gmail.com',
            'admin_phone' => '0923100330',
            'admin_password' => md5('123')  

        ]);
        $staff = Admin::create([
            'admin_name' => 'nv01',
            'admin_email' => 'nv01@gmail.com',
            'admin_phone' => '09892132222',
            'admin_password' => md5('123')   
        ]);
        $admin->roles()->attach($adminRoles);
        $staff->roles()->attach($staffRoles);


    }
}
