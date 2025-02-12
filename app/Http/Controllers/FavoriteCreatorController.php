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

        if ($user->id === $creator->user_id) {
            return redirect()->back()->with('error', 'You cannot favorite yourself.');
        }

        // お気に入り登録されていない場合
        if (!$user->favoriteCreators()->wherePivot('quest_creator_id', $creatorId)->exists()) {
            // 登録処理
            $user->favoriteCreators()->attach(['quest_creator_id' => $creatorId]);
        }

        // 再度更新された状態を渡すために、isFavoriteを確認
        $isFavorite = $user->favoriteCreators()->where('quest_creator_id', $creatorId)->exists();

        return redirect()->back()->with('isFavorite', $isFavorite);
    }


    //お気に入り解除
    public function destroy($creatorId)
    {
        $user = Auth::user();
        $creator = QuestCreator::findOrFail($creatorId);

        if ($user->favoriteCreators()->wherePivot('quest_creator_id', $creatorId)->exists()) {
            // お気に入り解除
            $user->favoriteCreators()->detach($creatorId);
        }

        // 再度更新された状態を渡すために、isFavoriteを確認
        $isFavorite = $user->favoriteCreators()->where('quest_creator_id', $creatorId)->exists();

        return redirect()->back()->with('isFavorite', $isFavorite);
    }

}
