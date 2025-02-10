<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestsChapter extends Model
{

    protected $fillable = ['quest_chapter_title', 'description'];
    
    // クエストとのリレーション
    public function quest(){
        return $this->belongsTo(Quest::class);
    }

    public function userQuests(){
        return $this->hasMany(UserQuest::class, 'quest_chapter_id');
    }
}
