<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class RolePermission extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        $permissions=Permission::all();
        $rolePermissions=$role->permissions;
        if(count($rolePermissions)>0){
            foreach($permissions as $permission){
                $permission->setAttribute('assigned',false);
                foreach($rolePermissions as $rolePermission){
                    // $permission->assigned=$permission->id===$rolePermission->id;
                    if($permission->id ===$rolePermission->id){
                        $permission->assigned=true;
                    }
                }

            }
        }
        return view("cms.spatie.role.rolePermission",['Permissions'=>$permissions,'role'=>$role]);
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
    public function store(Request $request,Role $role)
    {
        $validator=Validator($request->all(),[
            'permission_Id'=>'required|integer|exists:permissions,id'
        ]);
        if(!$validator->fails()){
            $permission=Permission::findOrFail($request->permission_Id);
            if($role->hasPermissionTo($permission)){
                $role->revokePermissionTo($permission);
            }else{
                $role->givePermissionTo($permission);
            }
            return response()->json(['message'=>'update successfully permission'],Response::HTTP_OK);

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
