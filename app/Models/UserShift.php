<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserShift extends Model
{
    protected $fillable = [
        'user_id',
        'substitute_user_id',
        'temp_changes',
        'date_from',
        'date_to',
    ];

    protected $table = 'users_shifts';

    public $timestamps = false;

    protected $casts = [
        'temp_changes' => 'array',
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function substituteUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'substitute_user_id');
    }
    public static function getFinishedShifts()
    {
        return self::where('date_to', '<', now()->startOfDay())
            ->where('temp_changes', '!=', NULL)
            ->get();
    }
    public static function getCurrentShifts()
    {
        return self::where('date_from', '<=', now()->startOfDay())
            ->where('date_to', '>=', now()->startOfDay())
            ->where('temp_changes', NULL)
            ->get();
    }
}
