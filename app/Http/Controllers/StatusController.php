<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quest;

class StatusController extends Controller
{
    
    public function viewQuestStatus($id)
    {
        
        return view('players.quests.queststatus');    
    }

}
