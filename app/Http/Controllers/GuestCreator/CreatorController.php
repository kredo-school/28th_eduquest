<?php

namespace App\Http\Controllers\GuestCreator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function myPage()
    {
        return view('guest-creators.mypage');
    }

    public function howToGuide()
    {
        return view('guest-creators.how-to-guide');
    }

    public function profile()
    {
        return view('guest-creators.profile');
    }

    public function edit()
    {
        return view('guest-creators.profile-edit');
    }
} 