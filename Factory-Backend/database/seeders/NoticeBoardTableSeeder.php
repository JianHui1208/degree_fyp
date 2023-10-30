<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\NoticeBoard;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class NoticeBoardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $noticeBoards = [];

        for ($i = 0; $i <= 10; $i++) {
            $noticeBoard = [
                'title' => $faker->name,
                'type' => rand(1, 2),
                'status' => rand(1, 2),
                'post_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'image_id' => rand(11, 20),
                'created_at' => Carbon::now()->addMinutes($i),
                'updated_at' => Carbon::now()->addMinutes($i),
            ];

            array_push($noticeBoards, $noticeBoard);
        }

        NoticeBoard::insert($noticeBoards);
    }
}
