<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewsRating extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'quest_id', 'rating', 'review'];

    // クエストとのリレーション
    public function quest(){
        return $this->belongsTo(Quest::class);
    }

    //userとのリレーション
    public function user(){
        return $this->belongsTo(User::class);
    }

}
