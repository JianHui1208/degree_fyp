<?php

namespace App\Console\Commands;

use App\Models\Image;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Delete:Image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Image after one day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        DB::beginTransaction();
        try {

            $image = Image::where([
                'status' => 0
            ])->get();

            foreach ($image as $value) {

                try {

                    $expire_date_time = strtotime($value->created_at . ' +1 day');

                    $now = strtotime("now");

                    if ($expire_date_time <= $now) {
                        if($value->document){
                            $value->document->delete();
                        }
                        $value->delete();
                    }

                    DB::commit();

                } catch (Exception $e) {

                    DB::rollback();

                    Log::channel('CronJob')->error([
                        'Image_id' => $value->id,
                        'controller' => 'DeleteImage',
                        'error' => $e->getMessage()
                    ]);

                    continue;
                }

            }

        } catch (Exception $e) {
            Log::channel('CronJob')->error([
                'controller' => 'DeleteImage',
                'error' => $e->getMessage()
            ]);

            return false;
        }

    }
}
