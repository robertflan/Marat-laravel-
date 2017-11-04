<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin = Role::create([
            'name' => 'Admin', 
            'slug' => 'admin',
            'permissions' => [
                'access-admin' => true,
                'manage-users' => true,
            ]
        ]);
        $manager = Role::create([
            'name' => 'Manager', 
            'slug' => 'manager',
            'permissions' => [
                'access-admin' => true,
                //'manage-users' => false,
            ]
        ]);
        $applicant = Role::create([
            'name' => 'Applicant', 
            'slug' => 'applicant',
            'permissions' => [
                //'access-admin' => false,
            ]
        ]);
    }
}
