<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class QuestCreator extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'quest_creators';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     * 
     */
   protected $fillable = [
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


     public function user(){
        return $this->belongsTo(User::class);
     }

     public function quests()
     {
         return $this->hasMany(Quest::class, 'quest_creator_id');
     }
    // // Userとのリレーション（多対一の関係）
    // public function user()
    // {
    //     return $this->belongsTo(User::class); // Userモデルと関連付け
    // }
}
