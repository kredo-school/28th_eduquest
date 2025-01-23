<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    //category has many quest_category
    public function questCategory(){
        return $this->hasMany(QuestCategory::class);
    }
}