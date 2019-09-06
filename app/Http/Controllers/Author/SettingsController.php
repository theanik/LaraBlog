<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function index(){
        return view('author.settings');
    
        }
    
        public function profileUpdate(Request $req){
            $req->validate([
                'name' => 'required',
                'email' => 'required|email',
                'image' => 'mimes:jpeg,bmp,png,jpg'
            ]);
    
            $image = $req->file('image');
            $slug = str_slug($req->name);
            $user = User::findOrFail(Auth::user()->id);
            if(isset($image)){
                $curTime = Carbon::now()->toDateString();
                $imgName = $slug.'-'.$curTime.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    
                if(!Storage::disk('public')->exists('profileImg')){
                    Storage::disk('public')->makeDirectory('profileImg');
    
                }
                if(Storage::disk('public')->exists('profileImg/'.$user->image)){
                    Storage::disk('public')->delete('profileImg/'.$user->image);
                }
    
                $profileImg = Image::make($image)->resize(500,500)->save($imgName,90);
    
                Storage::disk('public')->put('profileImg/'.$imgName, $profileImg); //(path, imgdata)
            }else{
                $imgName = $user->image;
            }
    
            $user->name = $req->name;
            $user->email = $req->email;
            $user->image = $imgName;
            $user->apout = $req->about;
            $user->save();
    
            Toastr::success('Profile Updated Successflly','success');
                return redirect()->back();
            Session::flash('ac_f','p');
    
        }
    
        public function passwordUpdate(Request $req){
            //return $req;
            $req->validate([
                'old_password' => 'required',
                'password' => 'required',
                'confirm_password' => 'required_with:password|same:password'
            ]);
            $hashedPass = Auth::user()->password;
            if(Hash::check($req->old_password,$hashedPass)){
                if(!Hash::check($req->password,$hashedPass)){
                    $user = User::findOrFail(Auth::id());
                    $user->password = Hash::make($req->password);
                    $user->save();
                    Toastr::success('Password Updated Successflly','success');
                    Auth::logout();
                    return redirect()->back();
    
                }else{
                    Toastr::error('New password same to old password','Error');
                    Session::flash('c_passErr','New password same to old password');
                    
                    return redirect()->back();
                }
            }else{
                Toastr::error('Old password dose not existst','Error');
                Session::flash('c_passErr','Old password dose not existst');
               
                return redirect()->back();
            }
    
    
        }
}
