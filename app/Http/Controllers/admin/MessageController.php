<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('type','!=','admin')->get();
        // $messageUsers=Message::select('receivers')->distinct()->get()->reverse();
        $messages=Message::orderBy('id','DESC')->get();
       return view('admin/inbox/index',compact('messages','users'));
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
        $request->validate(['message'=>'required']);
        if(isset($request->all_users)){
            $request->validate(['all_users'=>'required']);
            $users=User::where('type','!=','admin')->pluck('id');
            Message::create([
                'sender'=>Auth::id(),
                'receivers'=>json_encode(($users)),
                'message'=>$request->message,
                'seen'=>json_encode(array()),
                'deleted'=>json_encode(array()),
            ]);
        }else{
            $request->validate(['users'=>'required']);
            Message::create([
                'sender'=>Auth::id(),
                'receivers'=>json_encode($request->users,JSON_NUMERIC_CHECK),
                'message'=>$request->message,
                'seen'=>json_encode(array()),
                'deleted'=>json_encode(array()),
            ]);
        }

        return back()->with('success','Message sent successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users=User::where('type','!=','admin')->get();
        $messageUsers=Message::select('receivers')->distinct()->get()->reverse();
        $messageDetails=Message::where('id',$id)->first();
        $allMessageDetails=Message::where('receivers',$messageDetails->receivers)->get();
       return view('admin/inbox/show',compact('messageUsers','users','messageDetails','allMessageDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate(['message'=>'required']);
        $messageDetails=Message::where('id',$id)->first();
        Message::create([
            'sender'=>Auth::id(),
            'receivers'=>$messageDetails->receivers,
            'message'=>$request->message,
            'seen'=>json_encode(array()),
            'deleted'=>json_encode(array()),
        ]);
        return back()->with('success','Message sent successfully');
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

    public function delete($id){
        Message::where('id',$id)->delete();
        return back()->with('success','message deleted successfully');
    }

    public function selectedMessages(Request $request){
        $request->validate([
          'checked_messages'=>'required'
        ]);
        
          foreach($request->checked_messages as $ID){
            Message::where('id',$ID)->delete();
          }
       
        return back()->with('success','The selected messages have been deleted');
      }
}
