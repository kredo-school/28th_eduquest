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
        'quest_creator_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function creator()
    {
        return $this->belongsTo(QuestCreator::class, 'quest_creator_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'quest_category', 'quest_id', 'category_id');
    }
}