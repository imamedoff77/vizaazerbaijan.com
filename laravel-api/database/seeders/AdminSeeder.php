<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->name = 'Elşən';
        $admin->surname = 'Aslanov';
        $admin->email = 'application@vizaazerbaijan.com';
        $admin->password = bcrypt('5772877Im@');
        $admin->status = 'super';
        $admin->save();
    }
}
