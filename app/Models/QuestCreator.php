<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestCreator extends Model
{
    protected $fillable = ['creator_name', 'creator_image'];

    // Userとのリレーション（多対一の関係）
    public function user()
    {
        return $this->belongsTo(User::class); // Userモデルと関連付け
    }
}

