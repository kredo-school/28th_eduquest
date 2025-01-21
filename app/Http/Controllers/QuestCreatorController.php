<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestCreatorController extends Controller
{
    public function mypage(){
        return view('creator.mypage');
    }
}
