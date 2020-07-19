<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Contact;
use App\Contest;
use App\ContestParticipant;
use App\Page;
use Illuminate\Http\Request;
use App\Notifications\Contact as Message;
use Notification;

class FrontendController extends Controller
{
    public function index(){
        $latestContests=Contest::where('status','open')->orderBy('id','DESC')->limit(3)->get();
        $featuredContests=Contest::where('status','open')->where('is_featured',1)->orderBy('id','DESC')->get();
        return view('welcome',compact('latestContests','featuredContests'));
    }

    public function contests(){
        $categories=Category::all();
        if(isset($_GET['subCategory']) && isset($_GET['category'])){
            $contests=Contest::where('sub_category',$_GET['subCategory'])->where('status','open')->orderBy('id','DESC')->paginate(12);
        }else if(isset($_GET['category']) && !isset($_GET['subCategory'])){
            $contests=Contest::where('category',$_GET['category'])->where('status','open')->orderBy('id','DESC')->paginate(12);
        }else if(isset($_GET['type'])){
            $contests=Contest::where('file_type',$_GET['type'])->where('status','open')->orderBy('id','DESC')->paginate(12);
        }else if(isset($_GET['prized'])){
            $contests=Contest::whereNotNull('prize_description')->where('status','open')->orderBy('id','DESC')->paginate(12);
        }else{
            $contests=Contest::orderBy('id','DESC')->where('status','open')->paginate(12);
        }

        return view('contests/index',compact('contests','categories'));
    }

    public function quickview(){
        return view('contests/quickview');
    }
    public function prizes(){
        return view('contests/prizes');
    }
    public function wheel(){
        return view('games/wheel');
    }

    public function viewContest($id)
    {
        if(Auth::check()){
            $isParticipated=ContestParticipant::where('contest_id',$id)->where('user_id',Auth::id())->first();
        }else{
            $isParticipated='';
        }
        $contest=Contest::where('id',$id)->where('status','open')->firstOrFail();
        $participants=ContestParticipant::where('contest_id',$id)->get();
        return view('contests/show',compact('contest','participants','isParticipated'));
    }

    public function faq(){
        $details=Page::where('name','faq')->firstOrFail()->details;
        return view('static/faq',compact('details'));
    }

    public function terms(){
        $details=Page::where('name','terms')->firstOrFail()->details;
        return view('static/terms',compact('details'));
    }

    public function contact(){
        return view('static/contact');
    }

    public function submitContact(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ]);
        $contact=Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);

        $arr=['contact'=>$contact];

        Notification::route('mail', 'outfitszone@yahoo.com')
            ->notify(new Message($arr));


        return back()->with('success','Your message is now making it\'s way to us.');

    }


}
