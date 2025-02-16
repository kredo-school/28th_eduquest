<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controller\UserController;
use App\Http\Controller\BossController;
use App\Models\Boss;
use App\Models\Badge;
use App\Models\User;



class UserResultController extends Controller
{
    public function create(){
        $badge = Badge::all();
        
    }

    public function saveUserResult($user_id,$boss_id)
    {
        UserResult::create([
            'user_id' => $user->id,
            'boss_id' => $boss->id,
            'badge_name' => $badge->badge_name, 
            'badge_picture' => $badge->badge_picture, 
        ]);
    }

}
