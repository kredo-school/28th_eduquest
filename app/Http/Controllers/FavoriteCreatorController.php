<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Creator;
use App\Models\QuestCreator;
use Illuminate\Support\Facades\Auth;


class FavoriteCreatorController extends Controller
{
    //講師プロフィールのお気に入りボタン
    
    public function index()
    {
        // ユーザーのお気に入りクリエイターを取得
        $user = Auth::user();
        $favoriteCreators = $user->favoriteCreators;      // userモデルのfavoriteCreatorsリレーションを通じて取得する / $favoriteCreatorsは、QuestCreatorモデルのコレクション

        return view('players.favorites.index')->with('favoriteCreators', $favoriteCreators);
    }

    public function store($creatorId)
    {
        $user = Auth::user();
        $creator = QuestCreator::findOrFail($creatorId);

        //お気に入り
        $user->favoriteCreators()->attach($creator);

        return redirect()->back();
    }

    //お気に入り解除
    public function destroy($creatorId)
    {
        $user = Auth::user();
        $creator = QuestCreator::findOrFail($creatorId);

        //お気に入り解除
        $user->favoriteCreators()->detach($creator);

        return redirect()->back();
    }
}
