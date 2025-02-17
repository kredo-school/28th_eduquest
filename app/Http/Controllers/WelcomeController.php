<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quest;
use App\Models\Category;

class WelcomeController extends Controller
{
    private $quest;
    private $category;

    public function __construct(Quest $quest, Category $category)
    {
        $this->quest = $quest;
        $this->category = $category;
    }

    public function show()
    {
        $newestQuests = $this->quest
            ->with(['questCreator', 'categoryQuests.category'])
            ->latest()
            ->get();

        $categories = $this->category
            ->with('categoryQuests.quest.questCreator')
            ->get();

        return view('welcome', [
            'newestQuests' => $newestQuests,
            'categories' => $categories
        ]);
    }

}
