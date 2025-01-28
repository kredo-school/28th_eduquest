<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name'
    ];

    public function quests()
    {
        return $this->belongsToMany(Quest::class, 'quest_category', 'category_id', 'quest_id');
    }

    // ルートモデルバインディングのために追加
    public function getRouteKeyName()
    {
        return 'id';
    }
}
