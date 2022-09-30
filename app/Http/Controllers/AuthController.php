<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function getLogin($guard){
        return view("cms.Auth.login",['guard'=>$guard]);
    }

    public function login(Request $request){
        $validator=Validator($request->all(),[
            'email'=>'required',
            'password'=>'required',
            'guard'=>'required|string|in:admin,user'
        ]);
        if(!$validator->fails()){
            $cred=['email'=>$request->email,'password'=>$request->password];
            if(Auth::guard($request->guard)->attempt($cred,$request->remember)){
             return response()->json(['message' => 'the login is successful'], Response::HTTP_OK);
            }else{
                return response()->json(['message' => 'faild'], Response::HTTP_BAD_REQUEST);
            }

        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }
    public function a(Request $request){
        dd($request);
    }
    public function logout(Request $request){
        $guard=auth('admin')->check()?'admin':'user';
        auth($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('login',$guard);
    }
    public function editPass(){
        return view('auth.editPass');
    }
    public function updatePass(Request $request){
        $guard=auth('admin')->check() ? 'admin':'user';
    $validator=Validator($request->all(),[
      'oldPassword'=>"required",
      'newPassword'=>'required',
      'CnewPassword'=>'required|same:newPassword'
    ]);
    if(!Hash::check($request->oldPassword,Auth::user()->password)){
        return response()->json(['message'=>"the current password doesn't match"],Response::HTTP_BAD_REQUEST);
    } 
    if(!$validator->fails()){
    $user=auth($guard)->user();
    $user->password=Hash::make($request->newPassword);
    $isSaved=$user->save();
    return response()->json(['message'=>$isSaved?'successfully change passowrd':'faild change password'],
    $isSaved ? Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
    }else{
      return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
    }
    }
    public function editProfile(){
     $view=auth('admin')->check()?'cms.Admin.edit':'cms.user.edit';
     $guard=auth('admin')->check()?'admin':'user';
     return view($view,[$guard=>auth($guard)->user()]);
    }
}
