<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class userController extends Controller
{
    public function customerInformation(Request $request) {
        return "what";

        $arr=$request->json()->all();
        $customerData = DB::table('customeinformation')
        ->where('CustomerID', '=', $arr["id"])
        ->First();

        return response()->json($customerData);
    }

    public function userInfo(Request $request) {

        $arr=$request->json()->all();
        $customerData = DB::table('userinfo')
        ->where([['UserName', '=', $arr["UserName"]], ['Password', '=', $arr["Password"]]])
        ->First();

        return response()->json($customerData);
    }
    
    public function getCustomerOrders(Request $request) {

        $arr=$request->json()->all();
        $customerData = DB::select('select * from vw_customersale_invoice where CustomerID ='.$arr["id"]);
        
        return response()->json($customerData);
    }
}
