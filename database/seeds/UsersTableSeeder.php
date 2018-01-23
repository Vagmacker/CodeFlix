<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeFlix\Models\User::class, 1)->states('admin')->create([
            'name' => 'João Vagmacker',
            'email' => 'admin@user.com',
            'role' => \CodeFlix\Models\User::ROLE_ADMIN,
            'verified' => true
        ]);

        factory(\CodeFlix\Models\User::class, 20)->states('admin')->create()->each(function($user){
            $user->verified = true;
            $user->save();
        });
    }
}
