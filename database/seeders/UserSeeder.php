<?php


namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '0081d497-6898-4dfa-a412-acff8c21cb28',
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('bl0g123'),
            'remember_token' => null
        ]);
    }
}
