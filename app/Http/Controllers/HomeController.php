<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\News;

class HomeController extends Controller
{
    private $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    # Show the news in home page
     public function index()
    {
        $news_lists = $this->getNews();

        return view('players.home')->with('news_lists', $news_lists);
    }

    /**
     * Get all news.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getNews()
    {
        // Retrieve all news, ordered by the latest created date
        return $this->news->orderBy('created_at', 'desc')->get();
    }
}
