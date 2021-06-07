<?php

namespace App\Http\Controllers;

use App\Mail\UserConfirmationMail;
use App\Models\CartProduct;
use App\Models\User;
use App\Models\UserDetail;
use Mail;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\String_;

class UserController extends Controller
{

    public function __constructor(){
        $this->middleware('guest')->except('logout');
    }

    public function store(Request $request){

        $validated=$request->validate([
            'firstname'=>'required|min:3|max:30',
            'lastname'=>'required|min:3|max:30',
            'email'=>'required|email|unique:user',
            'password'=>'required|confirmed|min:5|max:15',
        ],
            [
                'email.required' => 'Email is required',
                'password.required' => 'Password is required'
            ]);

        $user=User::create([
            'username'=>$request->firstname . ' ' . $request->lastname,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'activation_key'=>Str::random(60),
            'is_active'=>0
        ]);

        //$user->detail()::create(new UserDetail());

        UserDetail::create(['user_id'=>$user->id]);

        Mail::to($request->email)->send(new UserConfirmationMail($user));

        if($user->is_active==0){
            return  redirect()->route('user.login')
                ->with('message','Email must be confirmed. Please check your email.')
                ->with('message_type','info');
        }

        auth()->login($user);
        return redirect()->route('home');

    }

    public function Register(Request $request){

        return view('user.register');
    }

    public function Confirm($key){
        $user=User::where('activation_key', $key)->first();

        if($user!=null){
            $user->activation_key = null;
            $user->is_active = 1;
            $user->save();
            return redirect()->to('/')
                    ->with('message','UserManagement Confirmation has been successful')
                    ->with('message_type','success');
        }
        else{
            return redirect()->to('/')
                ->with('message','UserManagement Confirmation not found.')
                ->with('message_type','danger');
        }
    }

    public function Login_form(){
        return view("user.login");
    }

    public function Login(){
        $this->validate(request(),[
            'email'=>'required|email',
            'password'=>'required|'
        ]);
        $user=User::where('email',request('email'))->first();

        if($user==null){
            return  redirect()->route('user.login')
                ->with('message','No matching user was found for this email.')
                ->with('message_type','danger');
        }
        if($user->is_active==0){
            return  redirect()->route('user.login')
                ->with('message','Email must be confirmed. Please check your email.')
                ->with('message_type','info');
        }

        if(auth()->attempt(['email'=>request('email'), 'password'=>request('password')],request()->has('remember_me'))) {
            request()->session()->regenerate();
            $active_cart_id=\App\Models\Cart::active_cart_id();

            if(is_null($active_cart_id)){
                $active_cart= \App\Models\Cart::create(['user_id'=>auth()->id()]);
                $active_cart_id=$active_cart->id;

            }

//            Database-de bu istifadeciye aid cart melumatlari varsa update olunur, yoxdursa yenisi
//            yaradilir.
            if(Cart::count()>0){
                foreach (Cart::content() as $cartItem){
                    CartProduct::updateOrCreate(
                        ['cart_id'=>$active_cart_id,'product_id'=>$cartItem->id],
                        ['quantity'=>$cartItem->qty, 'price'=>$cartItem->price,
                            'status'=>'Waiting']
                    );
                }
            }

            //Sessiondaki cart melumatlari silinir ve database-deki cart melumatlari sessiona add olunur.
            Cart::destroy();
            $cartProducts=CartProduct::where('cart_id',$active_cart_id)->get();
            foreach($cartProducts as $cartproduct){
                Cart::add($cartproduct->product->id,$cartproduct->product->name,
                    $cartproduct->quantity, $cartproduct->product->price,['slug'=>$cartproduct->product->slug] );
            }

            return redirect()->intended('/');
        }else{
            $errors=['email'=>'Email or password is not correct'];
            return back()->withErrors($errors);
        }

        return view();
    }

    public function Logout(){
        auth()->logout();
        //session icerisindeki melumatlari sifirlayiriq.
        request()->session()->flush();
        request()->session()->regenerate();

        return redirect()->route('home');
    }
}
