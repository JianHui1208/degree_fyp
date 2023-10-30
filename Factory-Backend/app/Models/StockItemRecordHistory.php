<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class StockItemRecordHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'stock_item_record_histories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'stock_history_id',
        'item_id',
        'old_quantity',
        'new_quantity',
    ];

    public function stockHistory()
    {
        return $this->belongsTo(StockHistory::class, 'stock_history_id');
    }

    function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
