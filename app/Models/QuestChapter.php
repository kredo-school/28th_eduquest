<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestChapter extends Model
{
    use HasFactory;

    protected $table = 'quests_chapters';

    protected $fillable = [
        'quest_chapter_title',
        'description',
        'video',
        'quest_id',  // quest_idを設定して、Questとのリレーションを作成
    ];

    // クエストとのリレーションを定義
    public function quest()
    {
        return $this->belongsTo(Quest::class, 'quest_id');
    }
}
