<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use App\Subscriber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DashBoardController extends Controller
{
    public function index(){
       $posts = Post::withCount('comments')
                    ->withCount('favorite_to_user')
                    ->orderBy('view_count','DESC')
                    ->orderBy('comments_count','DESC')
                    ->orderBy('favorite_to_user_count','DESC')
                    ->take(10)->get();
        $total_pending = Post::notapproved()->count();
        $all_viewCount = Post::sum('view_count');
         $new_author = User::authors()
                            ->whereDate('created_at',Carbon::today())->count();
         $active_user = User::authors()
                                ->withCount('posts')
                                ->withCount('comments')
                                ->orderBy('posts_count','DESC')
                                ->orderBy('comments_count','DESC')
                                ->take(10)->get();
        $author_count = User::authors()->count();
        $total_post = Post::all()->count();
        $total_category = Category::all()->count();
        $total_tag = Tag::all()->count();
        $total_subscriber = Subscriber::all()->count();

        $current_admin = Auth::user();
        $current_admin_populer = $current_admin->posts()
                                ->withCount('comments')
                                ->withCount('favorite_to_user')
                                ->orderBy('view_count','DESC')
                                ->orderBy('comments_count','DESC')
                                ->orderBy('favorite_to_user_count','DESC')
                                ->take(5)->get();
        $current_admin_total_view = $current_admin->posts()->sum('view_count');
        return view('admin.dashboard',
        compact('posts','total_pending','all_viewCount','new_author','active_user',
        'total_post','total_category','total_subscriber','total_tag','current_admin','current_admin_populer','current_admin_total_view'));
    }
}
