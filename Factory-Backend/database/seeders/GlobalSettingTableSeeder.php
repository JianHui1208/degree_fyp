<?php

namespace Database\Seeders;

use App\Models\GlobalSetting;
use Illuminate\Database\Seeder;

class GlobalSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            [
                'title'         => 'Email Verification',
                'type'          => 'Register',
                'layout'        => '2',
                'key'           => 'email_verification',
                'value'         => true,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'title'         => 'User Registration',
                'type'          => 'Register',
                'layout'        => '2',
                'key'           => 'users_regisration',
                'value'         => true,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ];

        GlobalSetting::insert($setting);

        // $setting = [
        //     // OTP Function
        //     [
        //         'title' => 'sendSMS username',
        //         'type'  => 'OTP SMS',
        //         'value' => 'ss4094',
        //     ],
        //     [
        //         'title' => 'sendSMS secret',
        //         'type'  => 'OTP SMS',
        //         'value' => 'c2bupq5ch',
        //     ],
        //     [
        //         'title' => 'OTP Verification on Registration',
        //         'type'  => 'OTP SMS',
        //         'value' => '1',
        //     ],
        //     [
        //         'title' => 'OTP Message',
        //         'type'  => 'OTP SMS',
        //         'value' => 'OTP verification code is: ',
        //     ],
        //     [
        //         'title' => 'OTP Pin Expired Time (min)',
        //         'type'  => 'OTP SMS',
        //         'value' => 5,
        //     ],
        // ];

        // SystemSetting::insert($setting);
    }
}
