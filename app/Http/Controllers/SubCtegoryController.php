<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCtegoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $subcategories=Subcategory::all();
         $categories=Category::all();
        return view('backend.subcategory.index',compact('subcategories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('backend.subcategory.create',compact('categories'));
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
            'subcategory_en'=>'required',
            'subcategory_bn'=>'required',
            'category_id'=>'required',

        ]);
        try{
            DB::beginTransaction();
            $subcategory=new Subcategory();
            $subcategory->subcategory_en=$request->subcategory_en;
            $subcategory->subcategory_bn=$request->subcategory_bn;
            $subcategory->category_id=$request->category_id;
            $subcategory->save();
            DB::commit();
            return redirect()->route('subcat.index');

        }catch(\Exception $ex){
            DB::rollBack();
            return $ex->getMessage();

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
        $subcategories=Subcategory::find($id);
        $categories=Category::all();
        return view('backend.subcategory.edit',compact('subcategories','categories'));
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
            'subcategory_en'=>'required',
            'subcategory_bn'=>'required',
            'category_id'=>'required',

        ]);
        $subcategories=Subcategory::find($id);
        $subcategories->subcategory_en=$request->subcategory_en;
        $subcategories->subcategory_bn=$request->subcategory_bn;
        $subcategories->category_id=$request->category_id;
        $subcategories->save();
        return redirect()->route('subcat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory =  Subcategory::find($id);
        if ($subcategory->icon != null){
            // unlink(public_path($subcategory->icon));
            ($subcategory->icon);
        }
        $subcategory->delete();
        // Alert::success('Sub-Category Deleted Successfully!.');
        return redirect()->route('subcat.index');
    }
}
