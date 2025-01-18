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
      'creator_image',
      'youtube',
      'facebook',
      'x_twitter',
      'linkedin',
   ];


     public function user(){
        return $this->belongsTo(User::class);
     }
}
