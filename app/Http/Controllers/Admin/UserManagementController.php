<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        if(!empty(request('wanted')))
        {
            //Search buttonuna basilan zaman bunu yazmayanda input icerisindeki axtarilan soz silinirdi.
            //Bunu ona gore yaziriq ki,flash() session icinde hemin sozu saxlayir ve buttona basilanda
            //axtarilan soz itmir.
            request()->flash();
            $wanted=request('wanted');
            $list=User::where('username','like', "%$wanted%")
                ->orwhere('email','like',"%$wanted%")
                ->orderbydesc('created_at')
                ->paginate(8)
                ->appends('wanted',$wanted);
        }
        else{
            $list=User::orderbydesc('created_at')->paginate(8);
        }

        return view('admin.UserManagement.index', compact('list'));
    }

    public function form($id = 0)
    {
        $user=new User;

        if($id>0){
            $user=User::find($id);
        }
        return view('admin.usermanagement.form', compact('user'));
    }

    public function save($id = 0)
    {
        //Xanalar doludurmu deye yoxlayiriq...
        $this->validate(request(),[
            'username'=>'required',
            'email'=>'required|email'
        ]);

        //Hele ki,username ve email columnlarini update edirik.
        $data=request()->only('username','email');

        //eger password doldurulubsa update olunacaq. Eger bos gelerse evvelki sifre qalacaq.
        if(request()->filled('password')){
            $data['password']=Hash::make(request('password'));
        }

        //is_active ve is_admin columnlarini update-e daxil etmek ucun...
        $data['is_active']=request()->has('is_active') && request('is_active') ? 1 : 0;
        $data['is_admin']=request()->has('is_admin') && request('is_admin')? 1 : 0;

        //Eger Update prosesidirse id gelecek yeni >0 olacaq.
        if($id>0){
            $user=User::find($id);
            $user->update($data);

            UserDetail::updateOrCreate(
                ['user_id'=>$user->id],
                ['address'=>request('address'), 'phone'=>request('phone')]
            );

            return redirect()->route('admin.usermanagement.update',$user->id)
                ->with('message_type','success')
                ->with('message','User Detail has been updated.');
        }
        //eks halda id gelmir deye create prosesi olur.
        else{
            $user=User::create($data);

            UserDetail::updateOrCreate(
                ['user_id'=>$user->id],
                ['address'=>request('address'), 'phone'=>request('phone')]
            );
        }
        return redirect()->route('admin.usermanagement')
            ->with('message_type','success')
            ->with('message','New user has been created.');


    }

    public function delete($id){
        if($id!=null){
            User::destroy($id);
            return redirect()->route('admin.usermanagement')
                ->with('message_type','success')
                ->with('message','User has been deleted.');
        }
        return redirect()->route('admin.usermanagement')
            ->with('message_type','danger')
            ->with('message','User is not found.');
    }
}
