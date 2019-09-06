<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function index(Request $req,$post){
       // return $post;
        $req->validate([
            'comment' => 'required'
        ]);

        $user = Auth::id();
        $comment = new Comment;
        $comment->post_id = $post;
        $comment->user_id = $user;
        $comment->comment = $req->comment;
        $comment->save();
        Toastr::success('Comment Succefully Published','Success');
        return redirect()->back();
    }
}
