<?php

namespace App\Models;
<<<<<<<<< Temporary merge branch 1
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
=========

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
    // Userとのリレーション（多対一の関係）
    public function user()
    {
        return $this->belongsTo(User::class); // Userモデルと関連付け
    }
}
>>>>>>>>> Temporary merge branch 2
