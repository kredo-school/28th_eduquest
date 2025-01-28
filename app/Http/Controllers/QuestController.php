<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Models\Category;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function show(Quest $quest)
    {
        return view('quests.show', compact('quest'));
    }

    public function indexByCategory(Category $category)
    {
        $quests = Quest::whereHas('categories', function($query) use ($category) {
            $query->where('categories.id', $category->id);
        })
        ->with(['categories', 'creator'])
        ->orderBy('created_at', 'desc')
        ->paginate(12);  // 4列×3行 = 12個に設定
        
        // デバッグ用のログ出力を追加
        \Log::info('Category ID: ' . $category->id);
        \Log::info('Quests count: ' . $quests->count());
        
        return view('welcome', [
            'quests' => $quests,
            'currentCategory' => $category
        ]);
    }
}