<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AdminRole extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Admin $admin)
    {
        $roles=Role::where('guard_name','admin')->get();
        $adminRoles=$admin->roles;
      if(count($adminRoles)>0){
        foreach($roles as $role){
            $role->setAttribute("assigned",false);
            foreach($adminRoles as $adminRole){
                if($adminRole->id==$role->id){
                    $role->setAttribute("assigned",true);

                }
            }
        }
      }
        return view('cms.Admin.Admin_Role',['roles'=>$roles,'admin'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Admin $admin)
    {
        $validator=Validator($request->all(),[
            'role_Id'=>'required|exists:roles,id'
        ]);
        if(!$validator->fails()){
            $role=Role::findOrFail($request->role_Id);
           if($admin->hasRole($role)){
            $admin->removeRole($role);
           }else{
            $admin->assignRole($role);
           }
           return response()->json(['message'=>'successfully change role for admin'],Response::HTTP_OK);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
