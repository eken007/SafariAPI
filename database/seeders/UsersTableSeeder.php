<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'codex sarl',
            'email' => 'sarlcodex@gmail.com',
            'type' => 2,
            'password' => Hash::make('codex@001')
        ]);
        User::create([
            'name' => 'eken franky',
            'email' => 'ekenfranky@gmail.com',
            'type' => 2,
            'password' => Hash::make('codex@002')
        ]);
    }
}
