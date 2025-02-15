<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_text',
        'points',
        'boss_id',
    ];

    public function boss()
    {
        return $this->belongsTo(Boss::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
