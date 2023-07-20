<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('settings.index');
    }

    
    public function changePassword(Request $request){
 
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect('/settings')->with("success","Password changed successfully !");
 
    }

    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required'
        ]);

        if($request->input('email') != Auth::user()->email){
            $this->validate($request,[
                'email' => 'unique:users|required'
            ]);
        }
            
        $user = User::find(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
 

        return redirect('/settings')->with("success","Information updated successfully !");

    }


}
