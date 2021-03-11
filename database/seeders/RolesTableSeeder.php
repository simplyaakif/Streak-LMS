<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Student',
            ],
            [
                'id'    => 3,
                'title' => 'Instructor',
            ],
            [
                'id'    => 4,
                'title' => 'Front Desk Officer',
            ],
        ];

        Role::insert($roles);
    }
}
