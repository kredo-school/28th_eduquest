<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuest extends Model
{
    protected $table = 'user_quest';
    protected $fillable = [
        'user_id', 
        'quest_id',
        'status',
        'date_started',
        'date_ended',
        'quest_chapter_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quest(){
        return $this->belongsTo(Quest::class, 'quest_id');
    }

    public function questsChapter(){
        return $this->belongsTo(QuestChapter::class, 'quest_chapter_id');
    }

}
