<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities=City::all();
        return view('cms.cities.index',['cities'=>$cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.cities.create');
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
            'name'=>'required|string|min:3|max:22',
            // 'active'=>'boolean'
        ],
       [
           'name.required'=>'الاسم مطلوب',           
       ]);
        $cities=new City();
        $cities->name=$request->name;
        $cities->active=$request->active ? true :false;
        $isSaved=$cities->save();
        event('category.empty');
         return redirect()->route('cities.index')->with('success','the city is update successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('cms.cities.edit',['city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name'=>'required|string|min:3|max:22',
        ]);
        $city->name=$request->name;
        $city->active=$request->active ? true :false;
        $isSaved=$city->save();
        return redirect()->route('cities.index')->with('success','the city is update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
       $isDeleted=$city->delete();
       if($isDeleted){
           return response()->json(['title'=>'city success deleted','text'=>'success','icon'=>'success'],Response::HTTP_OK);
       }else{
        //    return response()->json(['title'=>'city failed deleted','text'=>'error','icon'=>'error'],Response::HTTP_BAD_REQUEST);
       }
       
    }
}
