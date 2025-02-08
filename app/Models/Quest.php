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
        'category_name'  // category_nameを追加
    ];

    public function questCreator()
    {
        return $this->belongsTo(QuestCreator::class);
    }

    public function creator()
    {
        return $this->belongsTo(QuestCreator::class, 'quest_creator_id');
    }

    public function categoryQuests()
    {
        return $this->hasMany(CategoryQuest::class, 'quest_id');
    }

<<<<<<< HEAD
    // Categoryとのリレーションを定義
    public function categories()
=======
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
>>>>>>> f6870c683518bae3c1ddbf70ff10f08af877986e
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }



}