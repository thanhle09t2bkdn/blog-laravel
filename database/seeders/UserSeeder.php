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
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => app('hash')->make('admin123'),
            'role' => User::ADMIN_ROLE,
            'remember_token' => null
        ]);
        User::factory()
        ->count(10)
        ->create();
    }
}
