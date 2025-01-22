<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Quest;

class HomeController extends Controller
{
    private $news;
    private $quest;

    public function __construct(News $news, Quest $quest)
    {
        $this->news = $news;
        $this->quest = $quest;
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
    # Show the news in home page
    public function showNews()
    {
        $news = $this->getNews();
        $quests = $this->getQuests();

        return view('players.home', compact('news', 'quests'));
        
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
            $news_lists[] = $news;
        }
        
        return $news_list;
    }

    private function getQuests()
    {
        $all_quests = $this->quest->latest()->get();
        $quest_lists = [];

        foreach ($all_quests as $quest) {
            $quest_lists[] = $quest;
        }

        return $quest_lists;
    }
}
