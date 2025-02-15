<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuest extends Model
{
    use HasFactory;

    protected $table = 'user_quest';

    protected $fillable = [
        'user_id', 
        'quest_id', 
        'status', 
        'date_started', 
        'date_ended', 
        'quest_chapter_id'
    ];

    // リレーション: ユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // リレーション: クエスト
    public function quest()
    {
        return $this->belongsTo(Quest::class);
    }

    // リレーション: クエストチャプター
    public function questChapter()
    {
        return $this->belongsTo(QuestChapter::class);
    }

    // リレーション: ステータス
    public function statusHistory()
    {
        return $this->hasMany(UserQuestStatus::class);
    }
}
