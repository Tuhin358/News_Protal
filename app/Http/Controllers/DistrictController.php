<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts=District::all();
        return view('backend.district.index',compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.district.add_district');
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
            'district_en'=>'required',
            'district_bn'=>'required',
        ]);

        try{
            DB::beginTransaction();
            $district=new District();
            $district->district_en=$request->district_en;
            $district->district_bn=$request->district_bn;
            $district->save();
            DB::commit();
            return redirect()->route('district.index');

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
        $districts=District::find($id);
        return view('backend.district.edit',compact('districts'));
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
            'district_en'=>'required',
            'district_bn'=>'required',

        ]);
        $districts=District::find($id);
        $districts->district_en=$request->district_en;
        $districts->district_bn=$request->district_bn;
        $districts->save();
        return redirect()->route('district.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $districts = District::find($id)->delete();
        // Alert::success("Delete confirm");
        return redirect()->back();
    }
}
