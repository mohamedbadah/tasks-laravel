<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=Admin::withCount("roles")->get();
        return view('cms.Admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.Admin.create');
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
            'name'=>'required',
            'email' => 'required|email|unique:admins,email',
            'password'=>'required|min:6',
            'cpassword'=>'required|same:password'
        ]);
        if(!$validator->fails()){
         $admin=new Admin();
         $admin->name=$request->name;
         $admin->email=$request->email;
         $admin->password=Hash::make($request->password);
         $isSaved=$admin->save();
         Mail::to($request->email)->send(new Welcome($admin));
         return response()->json(['message'=>$isSaved ? 'successfully created admin':'fail created admin'],
        $isSaved?Response::HTTP_OK:Response::HTTP_BAD_REQUEST); 
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $admin_pass=Crypt::encrypt($admin->password);
        return view('cms.Admin.edit',compact('admin','admin_pass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $validator=Validator($request->all(),[
        'name'=>'required',
        'email'=>'required',
        ]);
        if(!$validator->fails()){
        $admin->name=$request->name;
        $admin->email=$request->email;
        $isUpdated=$admin->save();
        return response()->json(['message'=>$isUpdated ?'successfully updated admin':'faild updated information'],
    $isUpdated ? Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $isDeleted=$admin->delete();
        if($isDeleted){
            return response()->json(['icon'=>'Deleted','title'=>'is Deleted','text'=>'succesfully deleted'],Response::HTTP_OK);
        }else{
            return response()->json(['message'=>'faild deleted'],Response::HTTP_BAD_REQUEST);
        }
    }
}
