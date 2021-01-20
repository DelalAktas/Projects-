<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Image;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
    public function profile(){
        return view('profile', array('user'=>Auth::user()));
    }
    public function update_avatar(Request $request){
        //if($request->hasFile('avatar')){
           // $avatar = $request->file('avatar');
           // $filename = time().'.'.$avatar->getClientOriginalExtension();
          //  $avatar = Image::make($avatar)->resize(150,150);
          //  $avatar->insert(public_path('uploads/avatars/watermark.png'));
           // $avatar->save(public_path('uploads/avatars/'.$filename));
                //$avatar = Image::make($avatar)->pixelate(12)->resize(150,150)->save(public_path('uploads/avatars/'.$filename));
            //$user = Auth::user();
           // $user->avatar=$filename;
           // $user->save();
           // return view('profile',array('user'=>Auth::user()));
            

        //}

        //$user = User::find($id);
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $location = public_path('/uploads/avatars/' . $filename);
            $watermark = Image::make(public_path('/uploads/avatars/' . 'watermark.png'));
            Image::make($avatar)->resize(250,250)->insert($watermark->resize(150,150), 'center')->save($location);
            //$user = Auth::user();
            $user = auth()->user();
            $user->avatar = $filename;
            $user->save();
            return view('profile',array('user'=>Auth::user()));
        }

    }
  

}