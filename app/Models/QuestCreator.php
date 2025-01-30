<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestCreator extends Model
{
    use HasFactory;

    protected $fillable = ['creator_name', 'creator_image'];
    // Userとのリレーション（多対一の関係）
    public function user()
    {
        return $this->belongsTo(User::class); // Userモデルと関連付け
    }

    //questとのリレーション
    public function quests()
    {
        return $this->hasMany(Quest::class);
    }
}