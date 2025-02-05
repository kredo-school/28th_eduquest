<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Quest;
use App\Models\Category;

class HomeController extends Controller
{
    private $news;
    private $quest;
    private $category;

    public function __construct(News $news, Quest $quest, Category $category)
    {
        $this->news = $news;
        $this->quest = $quest;
        $this->category = $category;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index()
    {
        //
    }

    // ★★★★★ 1/28 要確認！！！　★★★★★
    # Show the news & categoriesin home page
    public function show()
    {
        $news_lists = $this->getNews();
        // $quests_lists = $this->getQuests();
        $categories = $this->category->with('categoryQuests.quest.questCreator')->get();
        $quests = Quest::all(); 
        return view('players.home', compact('news_lists', 'categories','quests'));
        
    }

    /**
     * Get all news.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getNews()
    {
        // Retrieve all news, ordered by the latest created date
        $all_news = $this->news->latest()->get();
        $news_list = [];

        foreach ($all_news as $news) {
            $news_list[] = $news;
        }
        
        return $news_list;
    }
}
