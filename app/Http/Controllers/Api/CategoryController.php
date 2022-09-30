<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        // $data=Category::where("user_id",auth("api")->user()->id)->get();
        $data=auth("api")->user()->categories;
        return response()->json(["message"=>"successfully","data"=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator=Validator($request->all(),[
        //     'name'=>'required|min:4|max:15',
        //     'active'=>'required'
        // ]);
        // if(!$validator->fails()){
        //     $category=new Category();
        //     $category->name=$request->name;
        //     $category->user_id=auth('api')->id();
        //     // $isSaved=$category->save();
        //     $isSaved=auth("api")->user()->categories()->save($category);
        //     return response()->json(["message"=>$isSaved?"successfully":"faild store category"],
        // $isSaved?Response::HTTP_CREATED:Response::HTTP_BAD_REQUEST);
        // return response()->json(["message"=>"successfully"],
        // Response::HTTP_CREATED);
        // }else{
        //     return response()->json(["message"=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        // }
        return $this->createOrUpdate($request);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        // $validator=Validator($request->all(),[
        //     'name'=>'required|min:3|max:30',
        //     'active'=>'required'
        // ]);
        // if(!$validator->fails()){
        //   $category->name=$request->name;
        //   $category->active=$request->active;
        //   $category->user_id=auth("api")->user()->id;
        //   $isSaved=$category->save();
        //   return response()->json(["message"=>$isSaved?"successfully updated category":"faild updated category"],
        // $isSaved ? Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
        // }else{
        //     return response()->json(["message"=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        // }
        return $this->createOrUpdate($request,$category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $CategoryItem=Category::where('id',$id)->first();     
        if(!is_null($CategoryItem)){
            $isDeleted=$CategoryItem->delete();
            return response()->json(["message"=>$isDeleted?"successfully deleted Item":"faild"],
        $isDeleted?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(["message"=>"faild deleted Item"],Response::HTTP_NOT_FOUND);
        }
    }
    private function createOrUpdate(Request $request,$id=null){
        $validator=Validator($request->all(),[
            'name'=>'required|min:3|max:30',
            'active'=>'required'
        ]); 
        $category=$id==null?new Category(): Category::findOrFail($id);
        $Sucess=$id==null ?Response::HTTP_CREATED:Response::HTTP_OK;
        if(!$validator->fails()){
           $category->name=$request->name;
           $category->active=$request->active;
           $category->user_id=auth("api")->user()->id;
           $isSaved=$category->save();
           return response()->json(["message"=>$isSaved ? "successfully":"faild"],
        $isSaved?$Sucess:Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(["message"=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }
    function user(){
        $category=Category::with('user')->get();
        return $category;
    }
}
