<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quest;
use App\Models\Category;

class QuestController extends Controller
{
    private $questcreator;

    public function __construct(Quest $quest){
        $this->quest = $quest;
    }

    public function viewCreateQuest()
    {
        return view('quests.create');
    }

    public function indexByCategory(Category $category)
    {
        $quests = Quest::whereHas('categories', function($query) use ($category) {
            $query->where('categories.id', $category->id);
        })
        ->with(['categories', 'questCreator'])
        ->orderBy('created_at', 'desc')
        ->paginate(12);
        
        return view('welcome', [
            'quests' => $quests,
            'currentCategory' => $category
        ]);
    }
}

