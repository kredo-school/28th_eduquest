<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChapterlistController extends Controller
{
    public function viewChapterList(){
        return view('players.quests.chapterlist');
    }
}

