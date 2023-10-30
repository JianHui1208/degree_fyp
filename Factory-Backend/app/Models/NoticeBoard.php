<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class NoticeBoard extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'notice_boards';

    public const STATUS_SELECT = [
        '1' => 'Inactive',
        '2' => 'Active',
    ];

    public const TYPE_SELECT = [
        '1' => 'HOME',
        '2' => 'SHOPPING',
    ];

    protected $dates = [
        'post_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'type',
        'post_at',
        'image_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
