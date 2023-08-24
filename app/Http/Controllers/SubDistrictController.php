<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subdistricts=Subdistrict::all();
        return view('backend.subdistricts.index',compact('subdistricts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $districts=District::all();
        return view('backend.subdistricts.create',compact('districts'));
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
            'subdistrict_en'=>'required',
            'subdistrict_bn'=>'required',
            'district_id'=>'required',
        ]);
        try{
            DB::beginTransaction();
            $subdistrict=new Subdistrict();
            $subdistrict->subdistrict_en=$request->subdistrict_en;
            $subdistrict->subdistrict_bn=$request->subdistrict_bn;
            $subdistrict->district_id=$request->district_id;
            $subdistrict->save();
            DB::commit();
            return redirect()->route('subdistrict.index');

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
        $subdistricts=Subdistrict::find($id);
        $districts=District::all();

        return view('backend.subdistricts.edit',compact('subdistricts','districts'));
        // ,compact('districts')
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
            'subdistrict_en'=>'required',
            'subdistrict_bn'=>'required',
            'district_id'=>'required',

        ]);
        $subdistricts=Subdistrict::find($id);
        $subdistricts->subdistrict_en=$request->subdistrict_en;
        $subdistricts->subdistrict_bn=$request->subdistrict_bn;
        $subdistricts->district_id=$request->district_id;
        $subdistricts->save();
        return redirect()->route('subdistrict.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subdistrict=Subdistrict::find($id);
        if($subdistrict->data!=null){
            $subdistrict->data;
        }
        $subdistrict->delete();
        return redirect()->back();
    }
}
