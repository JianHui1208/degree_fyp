<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CustomerPIC extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'customer_p_i_c_s';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'person_in_change_name',
        'person_in_change_phone',
        'person_in_change_email',
        'person_in_change_remark',
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
