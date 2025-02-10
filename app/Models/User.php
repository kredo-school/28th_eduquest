<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'player_nickname',
        'email',
        'first_name',
        'family_name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    

    public function questCreators(){
        return $this->hasOne(QuestCreator::class);
    }

    // クエストとのリレーション
    public function quest()
    {
        return $this->belongsTo(Quest::class);
    }

    // レビューレーティングとのリレーション
    public function reviews_ratings()
    {
        return $this->hasMany(ReviewsRating::class);
    }

    // クエストとのリレーション(favorite creator用)
    public function favoriteCreators()
    {
        return $this->belongsToMany(QuestCreator::class, 'favorites', 'user_id', 'quest_creator_id');
    }
    // ユーザーが持つクエスト
    public function userQuests()
    {
        return $this->hasMany(UserQuest::class);
    }
}