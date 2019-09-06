<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    public function store(Request $req){

        $req->validate([
            'email' => 'required|email|unique:subscribers'
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $req->email;
        $subscriber->save();
        Toastr::success('You Add Subscriber List Successfully','success');
        return redirect()->back();
    }
}
