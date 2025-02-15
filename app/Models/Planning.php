<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $table = 'planning'; 
    protected $fillable = ['date', 'quest_id', 'user_id'];

    public function quest()
    {
        return $this->belongsTo(Quest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
