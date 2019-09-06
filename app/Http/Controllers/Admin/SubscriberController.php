<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
class SubscriberController extends Controller
{
    public function index(){

        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber',compact('subscribers'));

    }

    public function delete($id){
        $subscribers = Subscriber::findOrFail($id);
        $subscribers->delete();
        Toastr::success('Subscriber Delete Successfully','success');
        return redirect()->back();

    }
}
