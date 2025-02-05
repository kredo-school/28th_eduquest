<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $fillable = [
        'category_name',
        // 他の必要なフィールド
    ];

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
