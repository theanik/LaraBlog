<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
class AuthorController extends Controller
{
    public function index(){
         $authors = User::authors()
        ->withCount('posts')
        ->withCount('favorite_posts')
        ->withCount('comments')
        ->get();

        return view('admin.authors.index',compact('authors'));
    }

    public function delete($id){
         $author = User::findOrFail($id);
        if($author){
            $author->delete();
            Toastr::success('Category Add successfylly','success');
            return redirect()->back();
        }
    }
}
