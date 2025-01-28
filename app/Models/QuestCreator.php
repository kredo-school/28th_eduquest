<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class QuestCreator extends Model
{
    protected $fillable = ['creator_name', 'creator_image'];

    // Userとのリレーション（多対一の関係）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Questsとのリレーション（一対多の関係）を追加
    public function quests()
    {
        return $this->hasMany(Quest::class, 'quest_creator_id');
    }
}