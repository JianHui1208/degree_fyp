<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'companies';

    public const SUBSCRIPTION_SELECT = [
        '0' => 'Free',
        '1' => 'Paid',
    ];

    public const STATUS_SELECT = [
        '0' => 'Inactive',
        '1' => 'Active',
    ];

    protected $fillable = [
        'name',
        'email',
        'subscription',
        'status',
        'user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
