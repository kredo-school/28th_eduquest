<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_name',
        'badge_picture',
    ];

    public function userResult()
    {
        return $this->belongsTo(UserResult::class);
    }

}
