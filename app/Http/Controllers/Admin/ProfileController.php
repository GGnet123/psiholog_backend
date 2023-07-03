<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {
    function index(Request $request){
        $ar = array();
        $ar['title'] = 'Профиль';
        $ar['action'] = route('admin_profile_save');
        $ar['request'] = $request;
        $ar['user'] = $request->user();

        return view('page.profile', $ar);
    }

    function save(Request $request){
        $user = $request->user();
        if (User::where('login', $request->login)->where('id', '<>', $user->id)->count() > 0)
            return redirect()->back()->with('error', 'Указанный логин уже есть');

        if ($request->new_pass && !Hash::check($request->old_pass, $user->password))
            return redirect()->back()->with('error', 'Указанный старый пароль не действителен');

        if ($request->new_pass)
            $user->password = Hash::make($request->new_pass);

        $user->login = $request->login;
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Все сохранено');
    }
}