<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Contact;
use Auth;
use App\Contest;
use App\ContestParticipant;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;
use FFMpeg;

class ContestController extends Controller
{
    public function list(){
        $contests=Contest::all();
        return view('admin/contests/list',compact('contests'));
    }

    public function edit($id){
        $categories=Category::all();
        $contest=Contest::where('id',$id)->firstOrFail();
        return view('admin/contests/edit',compact('contest','categories'));
    }

    public function update(Request $request)
    {
        
        $contest=Contest::where('id',$request->id)->firstOrFail();

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
            'title'=>$request->title,
            'category'=>$subCategory->category_id,
            'sub_category'=>$request->sub_category,
            'description'=>$request->description,
            'participants'=>$request->participants,
            
        ]);

        if(isset($request->prize)){
            $contest->update(['prize_description'=>$request->prize_description]);
        }else{
            $contest->update(['prize_description'=>NULL]);
        }
        if(isset($request->hasPost)){
            $contest->update(['post'=>$request->post]);
        }else{
            $contest->update(['post'=>NULL]);
        }

        if($request->hasFile('file')){
            $path=$request->file('file')->store('contest');
            $contest->update(['file'=>$path]);
            if($contest->file_type=='video'){
                FFMpeg::open($contest->file)
                ->getFrameFromSeconds(2)
                ->export()
                ->toDisk('local')
                ->save($contest->file.'.png');
                $contest->update(['thumbnail'=>$contest->file.'.png']);
            }else{
                $contest->update(['thumbnail'=>$contest->file]);
            }
        }

        return redirect(route('admin.contests'))->with('success','contest updated successfully');
    }

    public function delete($id){
        Contest::where('id',$id)->delete();
        return back()->with('success','contest deleted successfully');
    }

    public function show($id){
        $contest=Contest::where('id',$id)->firstOrFail();
        return view('admin/contests/show',compact('contest'));
    }

    public function updateEntry(Request $request){
        $request->validate([
            'file'=>'required'
        ]);
        $path=$request->file('file')->store('entries');
        ContestParticipant::where('id',$request->id)->update([
            'file'=>$path
        ]);
        return back()->with('success','contest entry updated successfully');
    }

    public function deleteEntry($id){
        ContestParticipant::where('id',$id)->delete();
        return back()->with('success','contest entry deleted successfully');
    }

    public function feature(Request $request){
        $contest=Contest::where('id',$request->contest)->firstOrFail();
        if($contest->is_featured==0){
            $contest->update(['is_featured'=>1]);
        }else{
            $contest->update(['is_featured'=>0]);
        }
        return response()->json(['status'=>'done']);
      }

}
