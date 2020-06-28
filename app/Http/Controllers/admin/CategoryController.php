<?php

namespace App\Http\Controllers\admin;

use DB;
use App\User;
use App\Page;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories=Category::with('getSubCategories')->paginate(5);
        return view('admin/category/index',compact('categories'));
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
        //return $request->all();

        $cat_id=Category::insertGetId([
          'name'=>$request->name,
        ]);

        foreach($request->subCategories as $subCategory)
          if($subCategory != ''){
            SubCategory::create([
              'name'=>$subCategory,
              'category_id'=>$cat_id,
            ]);
          }
        return back()->with('success','Category and SubCategories are added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Category $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($categoryID)
    {
      $catByID=Category::where('id',$categoryID)->first();
      return view('admin/category/edit',compact('catByID'));
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$catID)
    {
        DB::table('categories')
            ->where('id', $catID)
            ->update([
              'name'=>$request->name,
             ]);
        // foreach($request->subCategories as $key=>$subCategory){ 
        //   $isExist=SubCategory::where('id',$key)->first();
        //   if($isExist!=''){
        //     $isExist->update([
        //       'name'=>$subCategory
        //     ]);
        //   }else if(trim($subCategory)!=''){
        //     SubCategory::create([
        //       'name'=>$subCategory,
        //       'category_id'=>$catID,
        //     ]);
        //   }
        // }
         
        return redirect(route('admin.categories.index'))->with('success','Category is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($catID)
    {
        Category::where('id',$catID)->delete();
        SubCategory::where('category_id',$catID)->delete();
        return back()->with('success','Categories and SubCategories are deleted successfully');
    }

    public function deleteSubCategory($subCatID){
      SubCategory::where('id',$subCatID)->delete();
      return back()->with('success','The SubCategory is deleted successfully');
    }

    public function addSubCategory(Request $request){
      SubCategory::create([
        'name'=>$request->sub_category,
        'category_id'=>$request->category_id
      ]);
        return back()->with('success','SubCategory added successfully');
    }
    public function updateSubCategory(Request $request,$id){
      SubCategory::where('id',$id)->update([
        'name'=>$request->sub_category
      ]);
        return redirect(route('admin.categories.index'))->with('success','SubCategory updated successfully');
    }

    public function editSubCategory($subCatID)
    {
      $subCatByID=SubCategory::where('id',$subCatID)->first();
      return view('admin/category/editSubCategory',compact('subCatByID'));
    }


}
