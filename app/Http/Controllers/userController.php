<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class userController extends Controller
{
    public function signUp(Request $request) {
        
       
        $arr=$request->json()->all();



        $customerData = DB::table('userInfo')
        ->where('email', '=', $arr["email"])->First();
        if($customerData==null){
        $CID=DB::table('userInfo')->insertGetId([
            'Username'=>$arr["username"],
            'email'=>$arr["email"],
            'password'=>$arr["email"],
            "age"=>$arr["age"],
            "phone"=>$arr["phone"]
            
            ]);
       
            $data=json_encode($CID);
        return response()->json($data);
        }else{
            return response()->json(["email already exist"],500);
        }
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
    
    public function getCustomerOrders(Request $request) {

        $arr=$request->json()->all();
        $customerData = DB::select('select * from vw_customersale_invoice where CustomerID ='.$arr["id"]);
        
        return response()->json($customerData);
    }
}
