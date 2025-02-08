<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
<<<<<<< HEAD
    protected $table = 'categories';
=======
>>>>>>> f6870c683518bae3c1ddbf70ff10f08af877986e
    protected $fillable = ['category_name'];

    public function categoryQuests()
    {
        return $this->hasMany(CategoryQuest::class, 'category_id');
    }

<<<<<<< HEAD
    // Questとのリレーションを定義
    public function quests()
    {
        return $this->hasMany(Quest::class);
    }
=======

>>>>>>> f6870c683518bae3c1ddbf70ff10f08af877986e
}
