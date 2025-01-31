<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    #インスタンスを作成
    private $user;

    public function __construct(User $user){
        $this->user = $user;

    }
    
    #Switch to Quest Creatorの画面を表示
    public function viewSwitchToCreator($id)
    {
        return view('players.mypage.switch');    
    }

    #Account Securityの画面を表示
    public function viewAccountSecurity()
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        return view('players.mypage.accountsecurity');    
    }
    
    #Delete My Accountの画面を表示
    public function viewDeleteAccount($id)
    {
        return view('players.mypage.deleteaccount');    
    }

    #Change Email address
    public function updateEmailAddress(Request $request)
    {
        //
    }

    #Change Password
    public function updatePassword(Request $request)
    {
        //
    }

}