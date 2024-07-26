<?php
// database/seeders/UsersTableSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        // Create users
        User::firstOrCreate([
            'id' => 1,
            'role_id' => 1,
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);

        User::firstOrCreate([
            'id' => 2,
            'role_id' => 2,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        User::firstOrCreate([
            'id' => 3,
            'role_id' => 3,
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
