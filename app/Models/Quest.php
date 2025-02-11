<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
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

    public function questCreator()
    {
        return $this->belongsTo(QuestCreator::class, 'quest_creator_id');
    }

    public function creator()
    {
        return $this->belongsTo(QuestCreator::class, 'quest_creator_id');
    }

    public function categoryQuests()
    {
        return $this->hasMany(CategoryQuest::class, 'quest_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'quest_category', 'quest_id', 'category_id');
    }

    public function chapters()
    {
        return $this->hasMany(QuestChapter::class, 'quest_id');
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
    public function getAverageRatingAttribute()
    {
        return $this->reviews_ratings()->avg('rating');
    }
    
    // クエストが持つユーザークエスト
    public function userQuests()
    {
        return $this->hasMany(UserQuest::class);
    }
}