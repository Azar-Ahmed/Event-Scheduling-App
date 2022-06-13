<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class FrontController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('UserLogin')){
            return redirect('dashboard');
        }else{
            return view('front-end.index');
        }
    }

    public function dashboard(Request $request)
    {
        $value = $request->session()->get('key');
        $res['user'] = User::where('email', $value)->get();
        return view('front-end.dashboard', $res);
    }

    public function auth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $userExist = User::where('email', $email)->exists();
        if ($userExist) {
            $user = User::where('email', $email)->first();
            if($user){  
                if(Hash::check($password, $user->password)){
                    $request->session()->put('UserLogin', true);
                    $request->session()->put('UserID', $user->id);
                    return redirect('dashboard')->with('key', $user->email);  
                 }else{
                    return redirect('/')->with('error', 'Please enter valid password!');  
                 }
            }
        }else if($request->first_name != '-'){
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->save();
            return redirect('dashboard')->with('key', $user->email);  
        }else {
            return redirect('/')->with('error', 'Please create an account!');  
        }
    }
}
