<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $newsItems = News::all(); // データベースからニュースを取得
        return view('news', compact('newsItems')); // ビューにデータを渡す
    }
} 