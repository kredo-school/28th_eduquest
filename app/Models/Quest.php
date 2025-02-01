<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\QuestCreator;

class Quest extends Model
{
    protected $fillable = [
        'quest_title',
        'description',
        'thumbnail',
        'total_hours',
        'quest_creator_id'
    ];

    /**
     * カテゴリーとのリレーション
     */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questCreator()
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
}
