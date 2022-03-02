<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {
    function index(){
        $this->createDefaultAdmin();

        $ar = array();
        $ar['title'] = 'Форма входа';
        $ar['action'] = route('admin_login_check');

        return view('login', $ar);
    }

    function login(Request $request){
        $user = User::where(['login' => $request->input('login')])->where('type_id', User::ADMIN_TYPE)->first();
        if (!$user)
            return back()->with('error', 'Не правильный email/пароль 1');
        if (!Hash::check($request->password, $user->password))
            return back()->with('error', 'Не правильный email/пароль 2' );

        Auth::loginUsingId($user->id, true);

        return redirect()->route('admin_index')->with('success', 'Поздравляю вы вошли в систему управления. Удачи))' );
    }

    function logout(){
        Auth::logout();

        return redirect()->route('admin_index');
    }

    function createDefaultAdmin(){
        if (User::where('type_id', User::ADMIN_TYPE)->count())
            return;

        $user = new User();
        $user->type_id = User::ADMIN_TYPE;
        $user->login = 'admin';
        $user->password = Hash::make('346488');
        $user->save();
    }
}