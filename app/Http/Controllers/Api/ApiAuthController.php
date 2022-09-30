<?php

namespace App\Http\Controllers\Api;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    private function revokepreviousToken($user_id){
        DB::table('oauth_access_tokens')->where('user_id',$user_id)->update([
          'revoked'=>true
        ]);
    }
    private function checkForToken($user_id){
        DB::table('oauth_access_tokens')
        ->where('user_id',$user_id)->where('revoked',false)->exists();
    }
    // public function login(Request $request){
    //    $validator=Validator($request->all(),
    //    [
    //     'email'=>'required|email|exists:users',
    //     'password'=>'required|string'
    //    ]);
    //    if(!$validator->fails()){
    //     $user=User::where('email',$request->email)->first();
    //     if(Hash::check($request->password, $user->password)){
    //         // $this->revokepreviousToken($user->id);
    //         if(!$this->checkForToken($user->id)){
    //             $token=$user->createToken('user-api');
    //             // return $token;
    //             $user->setAttribute('token',$token->accessToken);
    //         return response()->json(['message'=>"successfully login","data"=>$user],Response::HTTP_BAD_REQUEST);
    
    //         }else{
    //     return response()->json(['message'=>"unable to login from two devices"],Response::HTTP_BAD_REQUEST);

    //         }
    //         }
    //        else{
    //     return response()->json(['message'=>"faild"],Response::HTTP_BAD_REQUEST);

    //     }

    //    }else{
    //     return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
    //    }
    // }
    public function login(Request $request){
        $validator=Validator($request->all(),[
            'email'=>'required|email|exists:users',
            'password'=>'required|string'
        ]);
        if(!$validator->fails()){
            try{
                $response=Http::asForm()->post('http://127.0.0.1:8001/oauth/token',[
                    'grant_type'=>'password',
                    'client_id'=>'3',
                    'scope'=>'*',
                    'client_secret'=>'wdkbcIhU7vnLI89M3nSTR16wr8ipc4W8AoP4ucgX',
                    'username'=>$request->email,
                    'password'=>$request->password
                  ]);
                  // return $response->json();
                  $user=User::where('email',$request->email)->first();
                  $user->setAttribute('token',$response->json()['access_token']);
                  $user->setAttribute('refreshToken',$response->json()['refresh_token']);
                  $user->setAttribute('token_type',$response->json()['token_type']);
                  return response()->json(['message'=>'successfully login','data'=>$user],Response::HTTP_OK);  
            }catch(Exception $e){
                $message="";
             if($response->json()['error']=='invalid_grant'){
                $message = "wrong cred, password or username is faild";
             }else{
                $message="login faild";
             }
             return response()->json(['message'=>$message],Response::HTTP_BAD_REQUEST);
            }
            
        }else{
         return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }
    public function logout(){
       $token= auth('api')->user()->token();
        $isRevoked=$token->revoke();
        return response()->json(['status'=>$isRevoked,'message'=>$isRevoked ? "Logout Successfully":"Faild To Logout"],
    $isRevoked ? Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
    }
    public function forgetPassword(Request $request){
     $validator=Validator($request->all(),[
        'email'=>'required|email|exists:users'
     ]);
     if(!$validator->fails()){
        $code=random_int(1000,9999);
        $user=User::where('email',$request->email)->first();
        $user->verification_code=Hash::make($code);
        $user->save();
      return response()->json(["message"=>"successfully","data"=>$code]);
     }else{
      return response()->json(["message"=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
     }
    }
    public function resetPassword(Request $request){
        $validator=Validator($request->all(),[
            'code'=>'required|numeric|digits:4',
            'password'=>'required|string',
            'cPassword'=>'required|same:password'
        ]);
        if(!$validator->fails()){
        $user=User::where('email',$request->email)->first();
        if(Hash::check($request->code,$user->verification_code)){
            $user->password=Hash::make($request->password);
            $isSaved=$user->save();
            return response()->json(["message"=>$isSaved?"sucessfully reset new password":"faild"],
            $isSaved?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
        }
        }else{
            return response()->json(["message"=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }
}
