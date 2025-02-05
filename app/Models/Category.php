<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category_name'];

    public function categoryQuests()
    {
        return $this->hasMany(CategoryQuest::class, 'category_id');
    }

    // Questとのリレーションを定義
    public function quests()
    {
        return $this->hasMany(Quest::class);
    }
}
