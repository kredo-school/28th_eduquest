<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = Faq::all(); // データベースからFAQを取得
        return view('FAQ-Contact', compact('faqs')); // ビューにデータを渡す
    }
} 