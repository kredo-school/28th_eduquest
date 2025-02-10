<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestStatus extends Model
{
    use HasFactory;

    protected $table = 'user_quest_status';

    protected $fillable = [
        'user_quest_id', 
        'status', 
        'status_date'
    ];

    // UserQuest
    public function userQuest()
    {
        return $this->belongsTo(UserQuest::class);
    }
}
