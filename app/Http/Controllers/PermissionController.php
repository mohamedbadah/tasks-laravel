<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions=Permission::all();
        return view('cms.spatie.permission.index')->with('permissions',$permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.spatie.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator($request->all(),[
       'name'=>'required|string|min:4|max:20',
       'guard'=>'required|string|in:admin,user'
        ]);
        if(!$validator->fails()){
         $permission=new Permission();
         $permission->name=$request->name;
         $permission->guard_name=$request->guard;
         $isSaved=$permission->save();
         return response()->json(['message'=>$isSaved?"successfully created permission":"faild created permission"],
        $isSaved?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
         
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],
            Response::HTTP_BAD_REQUEST);
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
        $permission=Permission::where('id',$id)->first();
        return view('cms.spatie.permission.edit',['permission'=>$permission]);
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
        $validator=Validator($request->all(),[
            'name'=>'required|string|min:4|max:30',
            'guard_name'=>'required|string|in:user,admin'
        ]);
        if(!$validator->fails()){
            $permission=Permission::where('id',$id)->first();
        $permission->name=$request->name;
        $permission->guard_name=$request->guard_name;
        $isUpdate=$permission->save();
            return response()->json(['message'=>$isUpdate?"successfully update permission":"faild update permission"],
            $isUpdate?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],
            Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission=Permission::where('id',$id)->first();
        $isDeleted=$permission->delete();
        if($isDeleted){
         return response()->json(['title'=>'successfully','icon'=>'success','text'=>'successfully deleted item'],
         Response::HTTP_OK);
        }else{
            return response()->json(['title'=>'faild!','text'=>'can not deleted item','icon'=>'success'],
            Response::HTTP_BAD_REQUEST);
        }
    }
}
