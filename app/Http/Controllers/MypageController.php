<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function viewMyPage($id){
        return view('players.mypage.mypage');
    }
    //
}
