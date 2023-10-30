<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Quotation extends Model
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
        'code',
        'term',
        'validation_date',
        'generate_date',
        'revised',
        'status',
        'remark',
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
}
