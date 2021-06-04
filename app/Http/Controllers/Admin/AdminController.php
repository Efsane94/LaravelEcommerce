<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use phpDocumentor\Reflection\Types\AbstractList;
use App\Models\User;

class AdminController extends Controller
{
    public function login()
    {
        if(request()->isMethod('POST')){
            $this->validate(request(),[
                'email'=>'required|email',
                'password'=>'required|'
            ]);

            $user=User::where('email',request('email'))->first();

            if($user==null){
                return  redirect()->route('admin.login')
                    ->with('message','No matching user was found for this email.')
                    ->with('message_type','danger');
            }

            if(!$user->is_active)
            {
                return  redirect()->route('admin.login')
                    ->with('message','Email must be confirmed. Please check your email.')
                    ->with('message_type','info');
            }
            $credentials=[
                'email'=>request('email'), 'password'=>request('password'), 'is_admin'=>1
                ];

            if(Auth::guard('admin')->attempt($credentials, request()->has(('rememberMe')))){
                return redirect()->route('admin.homepage');
            }
            else{
                return back()->withInput()->withErrors(['email'=>'No matching user was found for this email']);
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();

        request()->session()->flush();
        request()->session()->regenerate();

        return redirect()->route('admin.login');
    }


}
