<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class userController extends Controller
{
    public function signUp(Request $request) {
        // dd($request);
         $arr=$request->json()->all();
        // if($profile_picture = $request->hasFile('profile_picture')) {
        //     $profile_picture = time().'.'.$request->profile_picture->getClientOriginalExtension();
        //     $request->profile_picture->move(public_path('storage/profileimages'), $profile_picture);
        //     $profile_picture = 'storage/profileimages/'.$profile_picture;
        // } else {
        //     $profile_picture = NULL;
        // }
        
       
        
        //dd($arr);



        $customerData = DB::table('userInfo')
        ->where('email', '=', $arr["email"])->First();
        if($customerData==null){
        $CID=DB::table('userInfo')->insertGetId([
            'Username'=>$arr["username"],
            'email'=>$arr["email"],
            'password'=>$arr["password"],
            "profileimage"=>$arr["profile_picture"],
            "age"=>$arr["age"],
            "phone"=>$arr["phone"]
            
            ]);
       
            $data=json_encode($CID);
        return response()->json($data);
        }else{
            return response()->json(["email already exist"],500);
        }
    }
    public function uploadProfileImage(Request $request){
        $userId= $request["uid"];
        
        if($profile_picture = $request->hasFile('profile_picture')) {
            $profile_picture = time().'.'.$request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('storage/profileimages'), $profile_picture);
            $profile_picture = 'storage/profileimages/'.$profile_picture;
        } else {
            $profile_picture = NULL;
        }

        $re = DB::table('userInfo')
        ->where('UID', $userId)
        ->update([
        'profileimage'=>$profile_picture,
       
        ]);
        
        return response()->json(["imagePath"=>$profile_picture],200); 
         

    }

    public function login(Request $request) {

        $arr=$request->json()->all();
        $customerData = DB::table('userInfo')
        ->where([['email', '=', $arr["email"]], ['password', '=', $arr["password"]]])
        ->First();
        if($customerData==NULL){
            return response()->json(["Invalid User"],500);
        }else{

        return response()->json($customerData);
        }
    }
    public function getUser(Request $request,$uid) {

        
        $customerData = DB::table('userInfo')
        ->where([['uid', '=', $uid]])
        ->First();
        if($customerData==NULL){
            return response()->json(["Invalid User"],500);
        }else{

        return response()->json($customerData);
        }
    }
    
    public function insertDeviceToken(Request $request) {
try{
        $arr=$request->json()->all();
        $CID=DB::table('tbl_userDevice')->insertGetId([
            'DeviceToken'=>$arr["DeviceToken"],
            'userID'=>$arr["uid"],
           
            ]);
        
        return response()->json(["message"=>"Device token is stored","DeviceToken"=>$arr["DeviceToken"]],200); 
}catch (\Exception $e) {

    return $e->getMessage();
}
    }
    
    public function getDeviceToken(Request $request,$uid) {
        try{
           
               
                $DT = DB::table('tbl_userDevice')
        ->where([['userID', '=', $uid]
                    
                   
                    ])->get();
                    //dd($DT);
                    if($DT->count()<=1){
                        return response()->json(["Error"=>"User does not exist"],500);

                    }
                
                return response()->json(["DeviceToken"=>$DT->first()->DeviceToken],200); 
        }catch (\Exception $e) {
        
            return response()->json(["Error"=>$e->getMessage()],500);
        }
            }


    public function uploadImage(){


        if($profile_picture = $request->hasFile('profile_picture')) {
            $profile_picture = time().'.'.$request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('Storage/ProfileImages'), $profile_picture);
            $profile_picture = '/Storage/ProfileImages/'.$profile_picture;
        } else {
            $profile_picture = NULL;
        }
    }
}
