<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryQuest extends Model
{
    protected $table = 'quest_category';
    protected $fillable = ['quest_id', 'category_id'];
    public $timestamps = false;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function quest(){
        return $this->belongsTo(Quest::class, 'quest_id');
    }
}
