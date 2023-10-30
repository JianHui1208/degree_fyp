<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class QuotationItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'quotations';

    public const STATUS_SELECT = [
        '0' => 'Draft',
        '1' => 'Sent',
        '2' => 'Confirm',
        '3' => 'Rejected',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'remark',
        'image_id',
        'item_id',
        'quotation_id',
        'customer_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function images()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function quotations()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
}
