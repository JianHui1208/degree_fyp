<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ItemCategory extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'item_categories';

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
        'status',
        'image_id',
        'company_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'item_category_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
