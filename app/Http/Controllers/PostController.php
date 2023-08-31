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
use Illuminate\Support\Facades\File;

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
         //return view('backend.post.index',compact('posts'));

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
        $category=Category::find($posts->category_id);
        $district=District::find($posts->dis_id);

        $categories = Category::where('status',1)->latest()->get();
        $subcategories = Subcategory::where('status',1)->latest()->get();
        $districts = District::where('status',1)->latest()->get();
        $subdistricts = Subdistrict::where('status',1)->latest()->get();

        return view('backend.post.edit',compact('posts','categories','subcategories','districts','subdistricts','category','district'));
    }





    // public function update(Request $request, $id){

    //     $request->validate([
    //                 'category_id'=>'required',
    //                 'dis_id'=>'required',
    //                 // 'title_bd'=>'required',
    //                 // 'title_en'=>'required',
    //                 // 'details_bn'=>'required',
    //                 // 'tags_bn'=>'required',
    //                 // 'image'=>'required|mimes:png,jpg,jpeg,webp,svg',
    //             ]);

    //             try{
    //                 DB::beginTransaction();
    //                 $post=new Post();
    //                 $destination=public_path('images/headnews/');
    //                 if(!File::exists($destination)){
    //                     File::makeDirectory($destination,0755,true, true);
    //                 }
    //                 if($request->image!= null){
    //                     unlink(public_path($post->image));
    //             $image = $request->file('image');
    //             $imageName = rand(111111,999999).'.'.$image->getClientOriginalExtension();
    //             $image->move($destination, $imageName);
    //             $image_path = 'images/headnews/'.$imageName;
    //             $post->image = $image_path;
    //                 }
    //                 $post->title_bd=$request->title_bd;
    //                 $post->title_en=$request->title_en;
    //                 $post->category_id=$request->category_id;
    //                 $post->title_bd=$request->title_bd;


    //                 $post->tags_bn=$request->tags_bn;
    //                 $post->tags_en=$request->tags_en;
    //                 $post->details_en=$request->details_en;
    //                 $post->details_bn=$request->details_bn;
    //                 $post->headline=$request->headline;
    //                 $post->bigthumbnail=$request->bigthumbnail;
    //                 $post->first_section=$request->first_section;
    //                 $post->time_section_thumbnil=$request->time_section_thumbnil;
    //                 $post->post_date=$request->post_date;
    //                 $post->post_month=$request->post_month;

    //                 $post->save();
    //                 DB::commit();
    //                 // Alert::info('Product Update Done.');
    //                 return redirect()->route('all.post');


    //             }
    //             catch (\Exception $e) {
    //                 DB::rollback();
    //                 return $e->getMessage();
    //             }

    // }








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
            //'subcategory_id'=>$request->subcategory_id,
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
