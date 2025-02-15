<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $faqs = Faq::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('question', 'like', "%{$query}%")
                                ->orWhere('answer', 'like', "%{$query}%");
        })->get();

        return view('FAQ-Contact', compact('faqs', 'query'));
    }
} 