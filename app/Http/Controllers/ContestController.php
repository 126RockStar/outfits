<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Contest;
use App\SubCategory;
use Illuminate\Http\Request;

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
        $categories=Category::all();
        return view('contests/create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title'=>'required',
            'sub_category'=>'required',
            'description'=>'required',
            'participants'=>'required',
            'photo'=>'required',
        ]);

        if(isset($request->prize)){
            $request->validate(['prize_description'=>'required']);
        }
        $path=$request->file('photo')->store('contest');
        $subCategory=SubCategory::where('id',$request->sub_category)->firstOrFail();

        $contest=Contest::create([
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'category'=>$subCategory->category_id,
            'sub_category'=>$request->sub_category,
            'description'=>$request->description,
            'participants'=>$request->participants,
            'photo'=>$path,
        ]);

        if(isset($request->prize)){
            $contest->update(['prize_description'=>$request->prize_description]);
        }

        return redirect(route('user.dashboard'))->with('success','contest added successfully');
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
            'title'=>'required',
            'sub_category'=>'required',
            'description'=>'required',
            'participants'=>'required',
        ]);

        if(isset($request->prize)){
            $request->validate(['prize_description'=>'required']);
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
        }
        if($request->hasFile('photo')){
            $path=$request->file('photo')->store('contest');
            $contest->update(['photo'=>$path]);
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
        Contest::where('id',$id)->delete();
        return back()->with('success','contest delted successfully');
    }
}
