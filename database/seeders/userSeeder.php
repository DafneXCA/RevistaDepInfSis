<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'user' => 'admin@admin.com',
            'password' => bcrypt('dekumentor'),
        ]);
    }
}
