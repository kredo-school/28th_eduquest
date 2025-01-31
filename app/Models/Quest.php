<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quest extends Model
{
    protected $fillable = [
        'quest_title',
        'thumbnail',
        'creator_id'
    ];

    /**
     * カテゴリーとのリレーション
     */
    public function categoryQuests()
    {
        return $this->hasMany(CategoryQuest::class, 'quest_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'quest_category', 'quest_id', 'category_id');
    }

    /**
     * クリエイターとのリレーション
     */
    public function creator()
    {
        return $this->belongsTo(QuestCreator::class, 'quest_creator_id');
    }
}
