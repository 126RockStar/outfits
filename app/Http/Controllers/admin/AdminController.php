<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function userLists(){
        $users=User::withTrashed()->get();
        return view('admin/users/list',compact('users'));
    }

    public function blockUser($id){
        User::where('id',$id)->delete();
        return back()->with('success','the user is blocked successfully');
    }
    public function unblockUser($id){
        User::withTrashed()->where('id',$id)->restore();
        return back()->with('success','the user is unblocked successfully');
    }

    public function deleteUser($id){
        User::where('id',$id)->forceDelete();
        return back()->with('success','the user is deleted successfully');
    }

}
