<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\StockHistory;
use App\Models\StockItemRecordHistory;

class StockOutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            $stockHistoryValue = [
                'in_or_out' => 0,
                'total_quantity' => rand(1, 100),
                'description' => 'Stock Out History ' . $i,
                'company_id' => rand(1, 10),
                'created_at' => Carbon::now()->subDays($i),
                'updated_at' => Carbon::now()->subDays($i),
            ];
            $stockHistory = StockHistory::create($stockHistoryValue);
            $stockHistoryID = $stockHistory->id;

            for ($j = 1; $j <= rand(5, 10); $j++) {
                $stockItemRecordHistory = [
                    'stock_history_id' => $stockHistoryID,
                    'item_id' => rand(1, 500),
                    'old_quantity' => rand(21, 30),
                    'new_quantity' => rand(10, 20),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                StockItemRecordHistory::insert($stockItemRecordHistory);
            }
        }
    }
}
