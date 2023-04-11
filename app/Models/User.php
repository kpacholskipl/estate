<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_firstname',
        'user_lastname',
    ];
    protected $primaryKey = 'user_id';

    public function estates(): HasMany
    {
        return $this->hasMany(Estate::class, 'supervisor_user_id');
    }
}
