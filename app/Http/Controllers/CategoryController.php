<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories=Category::all();
      return view('cms.categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator(City::rules());
        if(!$validator->fails()){
            $category=new Category();
            $category->name=$request->name;
            $category->active=$request->active ? true :false;
            $image=$request->file('image');
            $new_image=time().'_category_.'.$image->getClientOriginalExtension();
            // $image->move(public_path('upload'),$new_image);
            $image->storeAs('upload',$new_image,['disk'=>'public']);
            $category->image=$new_image;
            $isSaved=$category->save();
            return response()->json(['message'=>$isSaved ?'successfully created cateory':'faild created category'],
            $isSaved ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('cms.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator=Validator($request->all(),
        [
            'name'=>'required|min:2|max:20',
            // 'image'=>'required|image|mimes:jpg,png,max:2040'
        ]);
        if(!$validator->fails()){
            $category->name=$request->name;
            $category->active=$request->active ? true:false;
            if($request->hasFile('image')){
                $image=$request->file('image');
                $new_image=time().'category_.'.$image->getClientOriginalExtension();
                $image->storeAs('upload',$new_image,['disk'=>'public']);
                $category->image=$new_image;
            }    
            $isUpdated=$category->save();
            return response()->json(['message'=>$isUpdated ? 'successfully update category':'faild updated'],
        $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $isDeleted=$category->delete();
        if($isDeleted){
            return response()->json(['icon'=>'success','title'=>'the category is successfully deleted','success'=>'the category is successfully deleted']);
        }else{
            return response()->json(['icon'=>'the category is faild deleted','title'=>'the category is faild deleted','text'=>'the category is faild deleted'],
        Response::HTTP_BAD_REQUEST);  
        }
    }
}
