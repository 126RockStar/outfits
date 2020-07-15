<?php

namespace App\Http\Controllers\admin;

use App\Contact;
use App\Contest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users=User::where('type','user')->get()->count();
        $contests=Contest::all()->count();
        $messages=Contact::where('status','unseen')->get()->count();
        return view('admin/dashboard',compact('users','contests','messages'));
    }



}
