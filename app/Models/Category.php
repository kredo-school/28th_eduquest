<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function categoryQuests()
    {
        return $this->hasMany(CategoryQuest::class, 'category_id');
    }
}
