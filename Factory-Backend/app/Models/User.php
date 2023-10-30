<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use Auditable;
    use HasFactory;
    use HasApiTokens;

    public const TYPE_SELECT = [
        '0' => 'Super Admin',
        '1' => 'Admin',
        '2' => 'User',
    ];

    public const STATUS_SELECT = [
        '0' => 'Inactive',
        '1' => 'Active',
    ];

    public const TWO_FACTOR_SELECT = [
        '0' => 'False',
        '1' => 'True'
    ];

    public $table = 'users';

    protected $hidden = [
        'two_factor_code', 'remember_token', 'email_verified_at',
        'password', 'verified', 'verified_at', 'verification_token',
        'created_at', 'updated_at', 'deleted_at', 'decrypt_key',
        'encrypt_key', 'id', 'two_factor_expires_at', 'two_factor', 'is_active'
    ];

    protected $dates = [
        'email_verified_at',
        'two_factor_expires_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'uid',
        'name',
        'username',
        'email',
        'password',
        'decrypt_key',
        'encrypt_key',
        'phone_number',
        'email_verified_at',
        'two_factor',
        'two_factor_code',
        'two_factor_expires_at',
        'remember_token',
        'type',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function generateTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getTwoFactorExpiresAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTwoFactorExpiresAtAttribute($value)
    {
        $this->attributes['two_factor_expires_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getRegisterTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setRegisterTimeAttribute($value)
    {
        $this->attributes['register_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
