<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;
use App\Models\Company;

class UsersTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $users = [
            [
                'uid'                   => app('App\Http\Controllers\BaseController')->generateUID('users'),
                'name'                  => 'Super Admin',
                'username'              => 'superadmin',
                'email'                 => 'superadmin@superadmin.com',
                'password'              => bcrypt('password'),
                'decrypt_key'           => app('App\Http\Controllers\BaseController')->generateKey(),
                'encrypt_key'           => app('App\Http\Controllers\BaseController')->generateKey(),
                'email_verified_at'     => null,
                'two_factor'            => 0,
                'two_factor_code'       => null,
                'two_factor_expires_at' => null,
                'remember_token'        => null,
                'phone_number'          => '+60181234569',
                'type'                  => 0,
                'is_active'             => true
            ],
            [
                'uid'                   => app('App\Http\Controllers\BaseController')->generateUID('users'),
                'name'                  => 'Admin',
                'username'              => 'admin',
                'email'                 => 'admin@admin.com',
                'password'              => bcrypt('password'),
                'decrypt_key'           => app('App\Http\Controllers\BaseController')->generateKey(),
                'encrypt_key'           => app('App\Http\Controllers\BaseController')->generateKey(),
                'email_verified_at'     => null,
                'two_factor'            => 0,
                'two_factor_code'       => null,
                'two_factor_expires_at' => null,
                'remember_token'        => null,
                'username'              => 'Admin',
                'phone_number'          => '+60181234568',
                'type'                  => 1,
                'is_active'             => true
            ],
            [
                'uid'                   => app('App\Http\Controllers\BaseController')->generateUID('users'),
                'name'                  => 'User',
                'username'              => 'user',
                'email'                 => 'user@user.com',
                'password'              => bcrypt('password'),
                'decrypt_key'           => app('App\Http\Controllers\BaseController')->generateKey(),
                'encrypt_key'           => app('App\Http\Controllers\BaseController')->generateKey(),
                'email_verified_at'     => null,
                'two_factor'            => 0,
                'two_factor_code'       => null,
                'two_factor_expires_at' => null,
                'remember_token'        => null,
                'username'              => 'user',
                'phone_number'          => '+60181234567',
                'type'                  => 2,
                'is_active'             => true
            ],
        ];

        User::insert($users);

        for ($i = 0; $i < 10; $i++) {
            $first_name = $faker->firstName;
            $last_name = $faker->lastName;
            $name = $first_name . ' ' . $last_name;
            $randFourDigit = rand(1000, 9999);
            $phone_number = '+601' . rand(2, 9) . $faker->randomNumber(7);

            $user = [
                'uid'                   => app('App\Http\Controllers\BaseController')->generateUID('users'),
                'name'                  => $name,
                'username'              => $first_name . $randFourDigit,
                'email'                 => $first_name . $randFourDigit . '@email.com',
                'password'              => bcrypt('password'),
                'phone_number'          => $phone_number,
                'type'                  => 2,
                'decrypt_key'           => app('App\Http\Controllers\BaseController')->generateKey(),
                'encrypt_key'           => app('App\Http\Controllers\BaseController')->generateKey(),
                'created_at'            => Carbon::now()->addMinutes($i),
                'updated_at'            => Carbon::now()->addMinutes($i),
            ];

            $user = User::create($user);
            $userID = $user->id;

            $company = [
                'name'                  => $first_name . ' Company',
                'email'                 => $last_name . $randFourDigit . '@email.com',
                'subscription'          => rand(0, 1),
                'status'                => rand(0, 1),
                'user_id'               => $userID,
                'created_at'            => Carbon::now()->addMinutes($i),
                'updated_at'            => Carbon::now()->addMinutes($i),
            ];

            $company = Company::create($company);

            $user->update(['company_id' => $company->id]);
        }
    }
}
