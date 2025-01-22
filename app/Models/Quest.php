<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    public function questCreator()
    {
        return $this->belongsTo(QuestCreator::class);
    }
}
