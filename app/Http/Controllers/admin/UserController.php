<?php

namespace App\Http\Controllers\admin;

use App\Contact;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::withTrashed()->get();
        return view('admin/users/list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::withTrashed()->where('id',$id)->firstOrFail();
        return view('admin/users/edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username'=>'required|unique:users,id,'.$id,
            'email'=>'required|email',
        ]);

        User::where('id',$id)->update([
            'username'=>$request->username,
            'email'=>$request->email,
        ]);

        return redirect(route('admin.users.index'))->with('success','User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
    public function messages(){
        $messages=Contact::all();
        return view('admin/contact/list',compact('messages'));
    }
    public function seenMessage($id){
        Contact::where('id',$id)->update(['status'=>'seen']);
        return back()->with('success','the message is marked as seen successfully');
    }
    public function unseenMessage($id){
        Contact::where('id',$id)->update(['status'=>'unseen']);
        return back()->with('success','the message is marked as unseen successfully');
    }
    public function deleteMessage($id){
        User::where('id',$id)->forceDelete();
        return back()->with('success','the user is deleted successfully');
    }


}
