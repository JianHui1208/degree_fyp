<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Item extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'items';

    public const STATUS_SELECT = [
        '0' => 'Inactive',
        '1' => 'Active',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'uid',
        'name',
        'barcode',
        'cost',
        'price',
        'item_category_id',
        'quantity',
        'image_id',
        'warehouse_id',
        'status',
        'supplier_id',
        'company_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
