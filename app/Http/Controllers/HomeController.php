<?php

namespace App\Http\Controllers;

use App\Contest;
use App\ContestParticipant;
use App\Message;
use App\SubCategory;
use Auth;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->type=='admin'){
            return redirect(route('admin.dashboard'));
        }else{
            
            return redirect(route('user.dashboard'));
        }
    }

    
    public function userDashboard()
    {
        $messages=Message::whereRaw('JSON_CONTAINS(receivers, \'[' . Auth::id() . ']\')')->whereRaw('not JSON_CONTAINS(deleted, \'[' . Auth::id() . ']\')')
          ->orderBy('id','desc')->paginate(20);

        $referredUsers=User::where('refered_user_id',Auth::id())->get();
        $contests=Contest::where('user_id',Auth::id())->where('status','open')->orderBy('id','DESC')->paginate(12);
        $allCreatedContests=Contest::where('user_id',Auth::id())->get();
        return view('home',compact('referredUsers','contests','allCreatedContests','messages'));
    }

    public function joinedContests()
    {
        $participatedContests=ContestParticipant::where('user_id',Auth::id())->pluck('contest_id');
        $contests=Contest::where('status','open')->where('user_id','!=',Auth::id())->WhereIn('id',$participatedContests)->orderBy('id','DESC')->paginate(12);
        return view('contests/joined',compact('contests'));
    }

    public function createdContests()
    {
        $referredUsers=User::where('refered_user_id',Auth::id())->get();
        $contests=Contest::where('user_id',Auth::id())->where('status','open')->orderBy('id','DESC')->paginate(12);
        $allCreatedContests=Contest::where('user_id',Auth::id())->get();
        return view('contests/created',compact('referredUsers','contests','allCreatedContests'));
    }

    public function deleteMessage($id){
        $message=Message::where('id',$id)->whereRaw('JSON_CONTAINS(receivers, \'[' . Auth::id() . ']\')')->firstOrFail();
        $deleteList=json_decode($message->deleted);
        array_push($deleteList,Auth::id());
        $message->deleted=json_encode($deleteList);
        $message->save();
        return back()->with('success','message deleted');
    }


    public function fetchSubCategory(Request $request){
        $subCategories = SubCategory::where("category_id",$request->catID)->pluck("name","id");
        return json_encode($subCategories);
    }

    public function editProfile()
    {
        return view('user/profile');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required|email',
            'password'=>'confirmed',
          ]);
          $user=User::where('id',Auth::id())->first();
          $user->update([
            'username'=>$request->username,
            'email'=>$request->email
          ]);
        //   if($request->hasFile('profile_picture')){
        //     $path=$request->file('profile_picture')->store('profilePicture');
        //     $user->update(['profile_picture'=>$path]);
        //   }

        if($request->password != ''){
            $user->update([
            'password'=>bcrypt($request->password),
            ]);
            return redirect(route('index'))->with('success','Profile updated, remember your new password:'.$request->password);
        }
        return redirect(route('index'))->with('success','Profile updated');
    }
 
}
