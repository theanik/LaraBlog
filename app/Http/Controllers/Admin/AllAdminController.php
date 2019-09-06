<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
class AllAdminController extends Controller
{
    public function index(){
        $admins = User::admin()->get();
        return view('admin.alladmin',compact('admins'));
    }
    public function createnew(){
        return view('admin.create_admin');
    }
    public function store(Request $req){
        $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user = new User();
        $user->role_id = 1;
        $user->name = $req->name;
        $user->username = str_slug($req->username);
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        Toastr::success('Admin Add successfylly','success');
        return redirect()->route('admin.admins.index');

    }

    public function delete($id){
       // return $id;
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success('Admin DELETED successfylly','success');
        return redirect()->route('admin.admins.index');
    }
    
}
