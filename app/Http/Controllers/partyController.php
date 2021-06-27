<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class partyController extends Controller
{
    public function createParty(Request $request) {
        try{
        
         $arr=$request->json()->all();

         $dateNow = Carbon::now()->toDateString();
         //dd($dateNow);

         $PID=DB::table('party')->insertGetId([
            'UserID'=>$arr["UserID"],
            'partySize'=>$arr["partySize"],
            'male'=>$arr["male"],
            "female"=>$arr["female"],
            "partyDate"=>Carbon::parse($arr['partyDate']),
            "lacationName"=>$arr["lacationName"],
            "logitute"=>$arr["logitute"],
            "latitute"=>$arr["latitute"],
            "Created_at"=>$dateNow,
            "PartyRating"=>$arr["PartyRating"],
            "Duration"=>$arr["Duration"],
            "Status"=>$arr["Status"]

            ]);
             return response()->json(["Message"=>"Paty is sussessfully created","PartyID"=>$PID],200);
        }catch (\Exception $e) {

             return response()->json(["Error"=>$e->getMessage()],500);
        }
        

       
    }
    public function getPartyDetails(Request $request,$UID) {
        try{
        
         $arr=$request->json()->all();
         $AllParties = DB::table('party')
         ->where([['UserID', '=', $UID]
                     
                    
                     ])->get();

         
             return response()->json(["Message"=>"All Partis of user","AllParties"=>$AllParties],200);
        }catch (\Exception $e) {

             return response()->json(["Error"=>$e->getMessage()],500);
        }
        

       
    }

}
