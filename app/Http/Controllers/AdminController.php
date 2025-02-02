<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function editAccount()
    {
        // Learnersのデータ取得
        $users = \App\Models\User::where('role_id', 1)
            ->select('id', 'player_nickname', 'first_name', 'family_name', 
                    'profile_image', 'created_at', 'last_login_at', 'violation_count')
            ->orderBy('created_at', 'desc')
            ->get();

        // Course Writersのデータ取得
        $creators = \App\Models\QuestCreator::with(['user' => function($query) {
            $query->select('id', 'last_login_at');
        }])
            ->select('id', 'user_id', 'creator_name', 'creator_image', 
                    'created_at', 'violation_count')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.admin-edit-account', [
            'creators' => $creators,
            'users' => $users
        ]);
    }
}
