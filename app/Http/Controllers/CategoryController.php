<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // public function_construct(){
    //     $this->middleware('auth');

    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=Category::all();
        return view('backend.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.add_cat');
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
            'category_en'=>'required',
            'category_bn'=>'required',

        ]);
        try{
            DB::beginTransaction();
            $category=new Category();
            $category->category_en=$request->category_en;
            $category->category_bn=$request->category_bn;
            $category->save();
            DB::commit();
            return redirect()->route('all.index');

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
        $categories=Category::find($id);
        return view('backend.category.edit',compact('categories'));
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
            'category_en'=>'required',
            'category_bn'=>'required',

        ]);
        $categories=Category::find($id);
        $categories->category_en=$request->category_en;
        $categories->category_bn=$request->category_bn;
        $categories->save();
        return redirect()->back();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::find($id)->delete();
        // Alert::success("Delete confirm");
        return redirect()->back();

    }
}
