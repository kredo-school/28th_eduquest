<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'option_id',
        'is_correct',
        'question_id',
    ];

    public function questions()
    {
        return $this->belongsTo(Question::class);
    }
}
