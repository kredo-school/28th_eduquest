<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class QuestCreator extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     * 
     */
   protected $fillable = [
      'user_id',
      'creator_name',
      'job_title',
      'description',
      'qualifications',
      'creator_image',
      'youtube',
      'facebook',
      'x_twitter',
      'linkedin',
   ];


     public function quests()
     {
         return $this->hasMany(Quest::class, 'quest_creator_id');
     }

    // questとのリレーション(favorite creator用)
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'quest_creator_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
