<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'suppliers';

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
        'UID',
        'company_name',
        'company_email',
        'company_phone',
        'fax',
        'address',
        'remark',
        'currency',
        'supplier_category_id',
        'avatar_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function supplier_categories()
    {
        return $this->belongsTo(SupplierCategory::class, 'supplier_category_id');
    }

    public function avatars()
    {
        return $this->belongsTo(Image::class, 'avatar_id');
    }
}
