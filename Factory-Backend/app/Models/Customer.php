<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'customers';

    public const STATUS_SELECT = [
        '0' => 'Active',
        '1' => 'Unactive',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'uid',
        'sstid',
        'company_name',
        'company_email',
        'company_phone',
        'fax',
        'address',
        'remark',
        'customer_category_id',
        'avatar_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function customer_categories()
    {
        return $this->belongsTo(CustomerCategory::class, 'customer_category_id');
    }

    public function images()
    {
        return $this->belongsTo(Image::class, 'avatar_id');
    }
}
