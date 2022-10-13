<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use App\Models\User;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@toxsl.in',
                'password' => Hash::make('admin@123'),
                'role' => 0,
            ]
        ]);
    }
}
