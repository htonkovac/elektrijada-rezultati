<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleUser  = Role::where('name', 'user')->first();

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@admin.admin';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($roleAdmin);

        $user = new User();
        $user->name = 'user';
        $user->email = 'user@user.user';
        $user->password = bcrypt('user');
        $user->save();
        $user->roles()->attach($roleUser);
    }
}
