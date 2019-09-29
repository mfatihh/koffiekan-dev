<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add role
        $roles = [
            [
                'name' => 'superadmin',
                'display_name' => 'Master',
                'description' => 'Hak akses untuk semua fitur',
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin store terdaftar',
                'description' => 'Hak akses untuk fitur store',
            ],
        ];
foreach ($roles as $key => $value) {
            Role::create($value);
        }
//add user
        $users = [
            [
                'name' => 'Owner',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123123'),
            ],
            [
                'name' => 'Admin Store',
                'email' => 'admin2@admin.com',
                'password' => bcrypt('123123'),
            ]
        ];
        $n=1;
        foreach ($users as $key => $value) {
            $user=User::create($value);
            $user->attachRole($n);
            $n++;
        }
    }
}
