<?php

namespace App\Http\Controllers\admin;

use App\Category;
use Auth;
use App\Contest;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;

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
            'user_id'=>Auth::id(),
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
        if($request->hasFile('photo')){
            $path=$request->file('photo')->store('contest');
            $contest->update(['photo'=>$path]);
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

}
