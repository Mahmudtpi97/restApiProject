<?php

namespace App\Http\Controllers;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use App\Models\details;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    // All User Data
    public function allData(){
         $allData =details::all();
         return $allData;
    }

    // Admin by User Data
    public function ADbyData(Request $request){
        $token = $request->input('access_token');
        $key = env('Access_Token'); //access_key generate by .env
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $token_array = (array)$decoded;
        $adminName = $token_array['user'];

        $allData =details::where('adminName',$adminName)->get();
        return $allData;
    }
//  User Data Insert
    public function dataInsert(Request $request){

        $this->validate($request, [
            'access_token' => 'required',
            'name' => 'required',
            'phone'    => 'required',
            'address'    => 'required'
        ]);

        $token = $request->input('access_token');
        $key = env('Access_Token'); //access_key generate by .env
        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        $token_array = (array)$decoded;
        $adminName = $token_array['user'];

        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        //  $created_at = time();

        $userCount = details::where('name', $name)->count();

    if ( $userCount !=0 ) {
        return " User Add Already Exists";
    }
    else{
        $result = details::insert([
            'adminName' => $adminName,
            'name'      =>$name,
            'phone'     =>$phone,
            'address'   =>$address,
            // 'created_at'   =>$created_at,
        ]);

        if ($result == true) {
            return "User Add Success";
        }
        else{
            return "User Add Fail !";
        }

    }
}
//  User Data Update
public function dataUpdate(Request $request,$name){
     // Access Token must be Used json data
        $this->validate($request, [
            'access_token' => 'required',
            'name' => 'required',
            'phone'    => 'required',
            'address'    => 'required'
        ]);

        $newName     =$request->input('name');
        $phone       =$request->input('phone');
        $address     =$request->input('address');

        $userCount = details::where('name', $newName)->count();

        if ($userCount != 0) {
            return " User Already Exists";
        }
        else{
            $result = details::where('name',$name)->update([
                    'name'      =>$newName,
                    'phone'     =>$phone,
                    'address'   =>$address
            ]);

            if($result == true) {
                return "User Update Successfully !";
            }
            else{
                return "User Update Fail !";
            }
        }

    }

//  User Data Delete
public function dataDelete(Request $request){
   // Access Token must be Used json data
     $name  = $request->input('name');

     $result = details::where('name',$name)->delete();
        if($result == true) {
            return "User Delete Successfully !";
        }
        else{
            return "User Delete Fail !";
        }

    }

}
