<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestCategory extends Model
{
    protected $table = "quest_category";  //中間テーブル名
    public $timestamps = false;
    protected $fillable = ['category_id', 'quest_id'];

    //quest_category belongs to categories
    public function category()
    {
        return  $this->belongsTo(Category::class);
    }

    //quest_category belongs to quest
    public function quest(){
        return $this->belongsTo(Quest::class);
    }
}
