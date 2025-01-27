<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name'];

    // category has many quest_category
    public function questCategory()
    {
        return $this->hasMany(QuestCategory::class);
    }
}
