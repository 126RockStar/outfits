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
            'max_contests'=>'required|numeric',
        ]);

        User::where('id',$id)->update([
            'username'=>$request->username,
            'email'=>$request->email,
            'max_contests'=>$request->max_contests,
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

    public function selectedUsers(Request $request){
        $request->validate([
          'checked_user'=>'required'
        ]);
        if(isset($request->type)){
            if($request->type=='unblock'){
                foreach($request->checked_user as $userID){
                    User::where('id',$userID)->restore();
                  }
                  return back()->with('success','The selected users have been unblocked');
            }else{
                foreach($request->checked_user as $userID){
                    User::where('id',$userID)->delete();
                  }
                  return back()->with('success','The selected users have been blocked');
            }
        }else{
          foreach($request->checked_user as $userID){
            User::where('id',$userID)->forceDelete();
          }
        }
       
        return back()->with('success','The selected users have been deleted');
      }

    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return back()->with('success','the contact message is deleted successfully');
    }

    public function selectedMessages(Request $request){
        $request->validate([
          'checked_messages'=>'required'
        ]);
        if(isset($request->type)){
            if($request->type=='unread'){
                foreach($request->checked_messages as $ID){
                    Contact::where('id',$ID)->update(['status'=>'unseen']);
                  }
                  return back()->with('success','The selected users have been unblocked');
            }else{
                foreach($request->checked_messages as $ID){
                    Contact::where('id',$ID)->update(['status'=>'seen']);
                  }
                  return back()->with('success','The selected users have been blocked');
            }
        }else{
          foreach($request->checked_messages as $ID){
            Contact::where('id',$ID)->forceDelete();
          }
        }
       
        return back()->with('success','The selected users have been deleted');
      }
  


}
