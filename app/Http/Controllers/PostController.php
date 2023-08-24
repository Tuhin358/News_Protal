<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\District;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\Subdistrict;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::get();
        return view('backend.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();
        $districts=District::get();
        // $subcategories=Subcategory::get();,'subcategories'
        return view('backend.post.create',compact('categories','districts'));
    }




public function getSubcategories($category_id)
{


     $subcategories=Subcategory::where('category_id',$category_id)->get();
     return response()->json($subcategories);
}

public function getSubdistricts($dis_id)
{
     $subdistricts=Subdistrict::where('district_id',$dis_id)->get();
     return response()->json($subdistricts);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('fkjfjk');
        $request->validate([
            'category_id'=>'required',
            'dis_id'=>'required',
            // 'title_bd'=>'required',
            // 'title_en'=>'required',
            // 'details_bn'=>'required',
            // 'tags_bn'=>'required',
            // 'image'=>'required|mimes:png,jpg,jpeg,webp,svg',
        ]);
        $image=$request->file('image');
        $name_gen=hexdec(uniqid());
        $img_ext=strtolower($image->getClientOriginalExtension());
        $img_name=$name_gen.'.'.$img_ext;
        $up_location='images/headnews/';
        $last_img=$up_location.$img_name;
        $image->move($up_location,$img_name);
        Post::insert([
            'title_bd'=>$request->title_bd,
            'title_en'=>$request->title_en,
            //  'user_id'=> Auth::user()->id,
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'dis_id'=>$request->dis_id,
             'subdis_id'=>$request->subdis_id,
            'image'=>$last_img,
            'tags_bn'=>$request->tags_bn,
            'tags_en'=>$request->tags_en,
            'details_en'=>$request->details_en,
            'details_bn'=>$request->details_bn,
            'headline'=>$request->headline,
            'bigthumbnail'=>$request->bigthumbnail,
            'first_section'=>$request->first_section,
            'time_section_thumbnil'=>$request->time_section_thumbnil,
            'post_date'=> Carbon::now(),
            'post_month'=>Carbon::now(),
        ]);
         return redirect()->route('all.post');



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
        $posts=Post::find($id);
        $categories = Category::get();
        $subcategories = Subcategory::get();
        $districts = District::get();
        $subdistricts = Subdistrict::get();

        return view('backend.post.edit',compact('posts','categories','subcategories','districts','subdistricts'));
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
            'category_id'=>'required',
            'dis_id'=>'required',
            // 'title_bd'=>'required',
            // 'title_en'=>'required',
            // 'details_bn'=>'required',
            // 'tags_bn'=>'required',
            // 'image'=>'required|mimes:png,jpg,jpeg,webp,svg',
        ]);
        $old_img=$request->old_img;
        $image=$request->file('image');
        $name_gen=hexdec(uniqid());
        $img_ext=strtolower($image->getClientOriginalExtension());
        $img_name=$name_gen.'.'.$img_ext;
        $up_location='images/headnews/';
        $last_img=$up_location.$img_name;
        $image->move($up_location,$img_name);
        unlink($old_img);

        Post::find($id)->Update([
            'title_bd'=>$request->title_bd,
            'title_en'=>$request->title_en,
            //  'user_id'=> Auth::user()->id,
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'dis_id'=>$request->dis_id,
             'subdis_id'=>$request->subdis_id,
            'image'=>$last_img,
            'tags_bn'=>$request->tags_bn,
            'tags_en'=>$request->tags_en,
            'details_en'=>$request->details_en,
            'details_bn'=>$request->details_bn,
            'headline'=>$request->headline,
            'bigthumbnail'=>$request->bigthumbnail,
            'first_section'=>$request->first_section,
            'time_section_thumbnil'=>$request->time_section_thumbnil,
            'post_date'=> Carbon::now(),
            'post_month'=>Carbon::now(),
        ]);
         return redirect()->route('all.post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts=Post::find($id);
        if($posts->image!==null){
            unlink(public_path($posts->image));
        }
        $posts->delete();
        return redirect()->back();
    }
}
