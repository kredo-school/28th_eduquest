<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestsChapter extends Model
{

    use HasFactory;

    protected $fillable = [
        'quest_id',
        'quest_chapter_title',
        'description',
        'video',
    ];
    
    // クエストとのリレーション
    public function quest(){
        return $this->belongsTo(Quest::class);
    }

    //次のチャプター
    public function nextChapter()
    {
        return Chapter::where('quest_id', $this->quest_id)
        ->where('id', '>', $this->id)
        ->orderBy('id', 'asc')
        ->first();
    }

    //前のチャプター
    public function prevChapter()
    {
        return Chapter::where('quest_id', $this->quest_id)
        ->where('id', '<', $this->id)
        ->orderBy('id', 'desc')
        ->first();;
    }
    
}
