<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    protected $fillable = ['category_name'];

    public function categoryQuests()
    {
        return $this->hasMany(CategoryQuest::class, 'category_id');
    }


}
