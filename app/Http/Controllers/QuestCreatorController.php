<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\QuestCreator;
use Illuminate\Http\Request;

class QuestCreatorController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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

    public function show($id)
    {
        $quest_creator = QuestCreator::findOrFail($id);
        return view('quest_creator.show', compact('quest_creator'));
    }

    public function assignQuestToUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->quest_creator_id = $request->quest_creator_id;
        $user->save();

        return redirect()->back()->with('success', 'Quest assigned successfully!');
    }
}
