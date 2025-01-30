<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    use HasFactory;

    protected $fillable = ['quest_name', 'description'];

    // ユーザーとのリレーション
    public function users()
    {
        return $this->hasMany(User::class);
    }
    // クエストクリエイターとのリレーション
    public function quest_creator(){
        return $this->belongsTo(QuestCreator::class);
    }
    // クエストチャプターとのリレーション
    public function quests_chapters()
    {
        return $this->hasMany(QuestsChapter::class);
    }
    // レビューレーティングとのリレーション
    public function reviews_ratings()
    {
        return $this->hasMany(ReviewsRating::class);
    }

    //レーティング平均
    public function averageRating()
    {
        return $this->reviews_ratings()->avg('rating');
    }
}
