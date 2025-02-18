<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = ['user_id', 'quest_creator_id'];

    public function creator()
    {
        return $this->belongsTo(QuestCreator::class, 'quest_creator_id');
    }
}
