<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;

use App\Models\University;
/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);


        User::create([
            'first_name' => 'IIUM',
            'last_name' => 'University',
            'email' => 'iium@user.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        University::create([
            'name'      => 'International Islamic University Malaysia',
            'acronym'   => 'IIUM',
            'user_id'   => 2,
        ]);

        User::create([
            'first_name' => 'USM',
            'last_name' => 'University',
            'email' => 'usm@user.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        University::create([
            'name'      => 'University Science Malaysia',
            'acronym'   => 'USM',
            'user_id'   => 3,
        ]);

        User::create([
            'first_name' => 'UM',
            'last_name' => 'University',
            'email' => 'um@user.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        University::create([
            'name'      => 'University Malaya',
            'acronym'   => 'UM',
            'user_id'   => 4,
        ]);

        User::create([
            'first_name' => 'Default',
            'last_name' => 'User',
            'email' => 'user@user.com',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);



        $this->enableForeignKeys();
    }
}
