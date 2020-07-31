<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Contest;
use App\ContestParticipant;
use App\Report;
use App\SubCategory;
use Faker\Provider\ar_JO\Company;
use FFMpeg;
use Illuminate\Http\Request;
use App\Notifications\Prize;
use App\Notifications\Judge;
use Notification;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCreatedContests=Contest::where('user_id',Auth::id())->get();
        if(count($allCreatedContests)<Auth::user()->max_contests){
            $categories=Category::all();
            return view('contests/create',compact('categories'));
        }else{
            return redirect(route('user.dashboard'))->with('error','You have reached the maximum limit of contest creation, please contact admin');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allCreatedContests=Contest::where('user_id',Auth::id())->get();
        if(count($allCreatedContests)<Auth::user()->max_contests){
            $request->validate([
                'title'=>'required|max:50',
                'sub_category'=>'required',
                'description'=>'required|max:150',
                'participants'=>'required',
                'file'=>'required|mimes:jpg,jpeg,png,bmp,gif,svg,mp4,webm',
            ]);

            if(isset($request->prize)){
                $request->validate(['prize_description'=>'required|max:50']);
            }


            // else if(strstr($mime, "image/")){
            //     // this code for image
            // }

            $path=$request->file('file')->store('contest');
            $subCategory=SubCategory::where('id',$request->sub_category)->firstOrFail();

            $contest=Contest::create([
                'user_id'=>Auth::id(),
                'title'=>$request->title,
                'category'=>$subCategory->category_id,
                'sub_category'=>$request->sub_category,
                'description'=>$request->description,
                'participants'=>$request->participants,
                'file'=>$path,
                'thumbnail'=>$path,
                'file_type'=>$request->file_type,
            ]);

            $myEntry=ContestParticipant::create([
                'user_id'=>Auth::id(),
                'contest_id'=>$contest->id,
                'file'=>$path,
                'thumbnail'=>$path,
            ]);


            if($contest->file_type=='video'){
                FFMpeg::open($contest->file)
                ->getFrameFromSeconds(2)
                ->export()
                ->toDisk('local')
                ->save($contest->file.'.jpg');
                $contest->update(['thumbnail'=>$contest->file.'.jpg']);
                $myEntry->update(['thumbnail'=>$contest->file.'.jpg']);
            }

            if(isset($request->prize)){
                $contest->update(['prize_description'=>$request->prize_description]);
                $arr=['contest'=>$contest];
                Notification::route('mail', $contest->getCreator->email)->notify(new Prize($arr));
            }

            return redirect(route('user.dashboard'))->with('success','contest added successfully');

        }else{
            return redirect(route('user.dashboard'))->with('error','You have reached the maximum limit of contest creation, please contact admin');
        }
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
        $categories=Category::all();
        $contest=Contest::where('id',$id)->firstOrFail();
        return view('contests.edit',compact('contest','categories'));
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
        
        $contest=Contest::where('id',$id)->firstOrFail();

        $request->validate([
            'title'=>'required|max:50',
            'sub_category'=>'required',
            'description'=>'required|max:150',
            'participants'=>'required',
        ]);

        if(isset($request->prize)){
            $request->validate(['prize_description'=>'required|max:50']);
        }

        $subCategory=SubCategory::where('id',$request->sub_category)->firstOrFail();
        $contest->update([
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'category'=>$subCategory->category_id,
            'sub_category'=>$request->sub_category,
            'description'=>$request->description,
            'participants'=>$request->participants,
            
        ]);

        if(isset($request->prize)){
            $contest->update(['prize_description'=>$request->prize_description]);
            $arr=['contest'=>$contest];
            Notification::route('mail', $contest->getCreator->email)->notify(new Prize($arr));
        }else{
            $contest->update(['prize_description'=>NULL]);
        }
        
        if($request->hasFile('file')){
            $path=$request->file('file')->store('contest');
            $contest->update(['file'=>$path,'file_type'=>$request->file_type]);
            if($contest->file_type=='video'){
                FFMpeg::open($contest->file)
                ->getFrameFromSeconds(2)
                ->export()
                ->toDisk('local')
                ->save($contest->file.'.jpg');
                $contest->update(['thumbnail'=>$contest->file.'.jpg']);
            }else{
                $contest->update(['thumbnail'=>$contest->file]);
            }
        }

        return redirect(route('user.dashboard'))->with('success','contest updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contest::where('id',$id)->where('user_id',Auth::id())->delete();
        return back()->with('success','contest deleted successfully');
    }

    public function participateContest (Request $request)
    {

        $contest=Contest::where('id',$request->id)->firstOrFail();
        $path=$request->file('file')->store('entries');
        $entry=ContestParticipant::create([
            'user_id'=>Auth::id(),
            'contest_id'=>$request->id,
            'file'=>$path,
        ]);

        if($contest->file_type=='video'){
            FFMpeg::open($entry->file)
            ->getFrameFromSeconds(2)
            ->export()
            ->toDisk('local')
            ->save($entry->file.'.jpg');
            $entry->update(['thumbnail'=>$entry->file.'.jpg']);
        }else{
            $entry->update(['thumbnail'=>$path]);
        }
        


        if(count($contest->getParticipants)>=$contest->participants){
            $contest->update(['status'=>'judge']);
            $arr=['contest'=>$contest];
            Notification::route('mail', $contest->getCreator->email)->notify(new Judge($arr));
        }


        return back()->with('success','contest participation successfully');
    }

    public function unjoinContest($id){
        $entry=ContestParticipant::where('contest_id',$id)->where('user_id',Auth::id())->firstOrFail();
        $entry->delete();
        return back()->with('success','Your contest entry is deleted successfully');
    }

    public function updatePost(Request $request){
        $entry=Contest::where('id',$request->id)->where('user_id',Auth::id())->firstOrFail();
        $entry->update(['post'=>$request->post]);
        return back()->with('success','Your contest post is updated successfully');
    }

    public function deletePost($id){
        $entry=Contest::where('id',$id)->where('user_id',Auth::id())->firstOrFail();
        $entry->update(['post'=>NULL]);
        return back()->with('success','Your contest post is deleted successfully');
    }

    public function reportContest($id){
        $entry=ContestParticipant::where('id',$id)->firstOrFail();
        return view('contests/report',compact('entry'));
    }
    public function storereportContest(Request $request){
        $request->validate([
            'contest_id'=>'required',
            'entry_id'=>'required',
            'reason'=>'required',
        ]);

        $entry=Report::create([
            'user_id'=>Auth::id(),
            'contest_id'=>$request->contest_id,
            'entry_id'=>$request->entry_id,
            'reason'=>$request->reason
        ]);
        
        if($request->hasFile('attachment')){
            $path=$request->file('attachment')->store('reports');
            $entry->update(['attachment'=>$path]);
        }
        return redirect(route('contest.show',$request->contest_id))->with('success','The contest entry is reported successfully');
    }
  
}
