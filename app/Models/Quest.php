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


    //Quest has many quest_category
    public function questCategory()
    {
        return $this->hasMany(QuestCategory::class, 'quest_id');
    }

    public function creator()
    {
        return $this->belongsTo(QuestCreator::class, 'quest_creator_id');
    }

    public function chapters()
    {
        return $this->hasMany(QuestChapter::class, 'quest_id');
    }
}
