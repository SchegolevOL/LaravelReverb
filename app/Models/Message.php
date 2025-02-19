<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $appends=['formatted_date'];
    protected $fillable=[
        'sender_id',
        'receiver_id',
        'message',
        'file_name',
        'file_original_name',
        'folder_path',
        'is_read',
        'file_type'
    ];


    /**
     * Function:sender
     * @return BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id', 'id');
    }

    /**
     * Function: receiver
     * @return BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id', 'id');
    }
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->created_at = Carbon::now();
        });
    }

    public function getFormattedDateAttribute()
    {
        $date = Carbon::parse($this->created_date);
        return $date->isToday() ? 'Today' :($date->isYesterday()?'Yesterday':$date->format('d-m-Y'));
    }
}
