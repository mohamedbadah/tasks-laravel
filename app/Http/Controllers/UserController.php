<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::withCount("permissions")->get();
        return view('cms.user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('cms.user.create');
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
         'name'=>'required|string:min:3|max:20',
         'email'=>'required|email|unique:users,email',
         'password'=>'required|string|min:6|max:40',
         'cpassword'=>'required|same:password'
        ]);
        if(!$validator->fails()){
          $user=new User();
          $user->name=$request->name;
          $user->email=$request->email;
          $user->verification_code=Hash::make(rand(1000,9999));
          $user->password=Hash::make($request->password);
          $isSaved=$user->save();
          return response()->json(['message'=>$isSaved?'successfully created new user':'faild created new user'],
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
        $user=User::where('id',$id)->first();
        return view('cms.user.edit',compact('user'));
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
            'name'=>'required|min:3|max:20',
            'email'=>'required|email'
        ]);
        if(!$validator->fails()){
          $user=User::findOrFail($id);
        //   $user->name=$request->name;
        //   $user->email=$request->email;
        $user->update([
         'name'=>$request->name,
         'email'=>$request->email
        ]);
          $isUpdated=$user->save();
          return response()->json(['message'=>$isUpdated?'successfully edit profile':'faild edit profile'],
        $isUpdated?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
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
       $user=User::where('id',$id)->first();
       $isDeleted=$user->delete();
       if($isDeleted){
        return response()->json(['icon'=>'Deleted','title'=>'is Deleted','text'=>'succesfully deleted'],Response::HTTP_OK);
    }else{
        return response()->json(['message'=>'faild deleted'],Response::HTTP_BAD_REQUEST);
    }
    
    }
}
