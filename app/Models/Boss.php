<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boss extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'passing_score',
        'quest_id', 
    ];

    public function quest()
    {
        return $this->belongsTo(Quest::class);
    }
}
