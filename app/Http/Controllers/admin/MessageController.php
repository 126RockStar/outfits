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
        $messageUsers=Message::select('receivers')->distinct()->get();
       return view('admin/inbox/index',compact('messageUsers','users'));
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
                'receivers'=>json_encode($users),
                'message'=>$request->message,
                'seen'=>json_encode(array()),
                'deleted'=>json_encode(array()),
            ]);
        }else{
            $request->validate(['users'=>'required']);
            Message::create([
                'sender'=>Auth::id(),
                'receivers'=>json_encode($request->users),
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
        //
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
}
