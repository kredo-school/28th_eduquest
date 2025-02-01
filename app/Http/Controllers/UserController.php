<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    public function viewAccountSecurity($id)
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
        $request->validate([
            'email'    => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'required', // 現在のパスワード
        ]);

        $user = Auth::user();

        // パスワード一致確認
        if(! Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'The provided password does not match your current password.'
            ]);
        }

        // Update email
        $user->email = $request->email;
        $user->save();

        return back()->with('status', 'Email updated successfully!');
    }

    #Change Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentpass' => 'required',
            'newpass'     => 'required|min:8',
            'newpass2'    => 'required|same:newpass',
        ]);

        $user = Auth::user();

        // 旧パスワードチェック
        if(! Hash::check($request->currentpass, $user->password)) {
            return back()->withErrors([
                'currentpass' => 'The current password is incorrect.'
            ]);
        }

        // 新パスワード更新
        $user->password = Hash::make($request->newpass);
        $user->save();

        return back()->with('status', 'Password updated successfully!');
    }

}