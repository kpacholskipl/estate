<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estate extends Model
{
    protected $fillable = [
        'supervisor_user_id',
        'street',
        'building_number',
        'city',
        'zip'
    ];
    public $timestamps = false;

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_user_id');
    }

}
