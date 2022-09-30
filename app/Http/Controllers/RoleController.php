<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::withCount('permissions')->get();
        return view('cms.spatie.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cms.spatie.role.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'guard' => 'required|string|in:admin,user'
        ]);
        if(!$validator->fails()){
            $role=new Role();
            $role->name=$request->name;
            $role->guard_name=$request->guard;
            $isSaved=$role->save();
            return response()->json(['message'=>$isSaved?"successfully created new role":"faild created new role"],
        $isSaved?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
         }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
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
        $role=Role::where('id',$id)->first();
        return view('cms.spatie.role.edit',['role'=>$role]);
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
            'name'=>'required|string|min:3|max:20',
            'guard_name'=>'required|string|in:admin,user'
        ]);
        if(!$validator->fails()){
            $role=Role::findOrFail($id);
            $role->name=$request->name;
            $role->guard_name=$request->guard_name;
            $isUpdate=$role->save();
            return response()->json(['message'=>$isUpdate?"successfully":"faild"],
        $isUpdate?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
        }else{
         return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
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
        $role=Role::where('id',$id)->first();
        $isDeleted=$role->delete();
        if($isDeleted){
            return response()->json(["title"=>"Success!","text"=>"data is deleted","icon"=>"success"]
            ,Response::HTTP_OK);
        }else{
            return response()->json(["title"=>"faild!","text"=>"data is not deleted","icon"=>"error"]
        ,Response::HTTP_BAD_REQUEST);
        }
    }
}
