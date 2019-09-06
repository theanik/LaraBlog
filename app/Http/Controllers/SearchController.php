<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class SearchController extends Controller
{
    public function index(Request $req){
        //return $req;
        $data = $req->search;
        $posts = Post::where('title','LIKE',"%$data%")->paginate(15);
        return view('posts',compact('posts','data'));
    }
}
