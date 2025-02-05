<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    use HasFactory;

    protected $fillable = [
        'quest_title',
        'description',
        'thumbnail',
        'total_hours',
        'quest_creator_id',
    ];

    //public function user()
    //{
    //    return $this->belongsTo(User::class);
    //}
    public function questCreator()
    {
        return $this->belongsTo(QuestCreator::class);
    }

    public function categoryQuests()
    {
        return $this->hasMany(CategoryQuest::class, 'quest_id');
    }
    // ユーザーとのリレーション
    public function users()
    {
        return $this->hasMany(User::class);
    }
    // クエストチャプターとのリレーション
    public function questsChapters()
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

