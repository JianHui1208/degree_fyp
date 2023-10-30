<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'stock_histories';

    public const IN_OR_OUT_SELECT = [
        '0' => 'Out',
        '1' => 'In',
        '2' => 'Adjust',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'in_or_out',
        'total_quantity',
        'description',
        'company_id'
    ];

    public function stockItemRecordHistories()
    {
        return $this->hasMany(StockItemRecordHistory::class, 'stock_history_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
