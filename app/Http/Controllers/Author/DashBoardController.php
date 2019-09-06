<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
class DashBoardController extends Controller
{
    //author

    public function index(){
        $user = Auth::user();
        $populer_posts = $user->posts()
            ->withCount('comments')
            ->withCount('favorite_to_user')
            ->orderBy('view_count','DESC')
            ->orderBy('comments_count')
            ->orderBy('favorite_to_user_count')
            ->take(5)->get();
        $total_pending = $user->posts()->notapproved()->count();
        $all_viewCount = $user->posts()->sum('view_count');
        return view('author.dashboard', compact('user','populer_posts','total_pending','all_viewCount'));
    }
}
