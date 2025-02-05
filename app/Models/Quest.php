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
        'category_name'  // category_nameを追加
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

    // Categoryとのリレーションを定義
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

