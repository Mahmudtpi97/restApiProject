<?php

namespace App\Http\Controllers;

use App\Models\registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
  public function register(Request $request){
    
        $this->validate($request, [
            'username' => 'required|unique:registration',
            'phone'    => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);

       $formData =  $request->all();
       $username = $request->input('username');
       $userCount = registration::where('username', $username)->count();

    if ( $userCount !=0 ) {
        return " User Registration Already Exists";
    }
    else{
        $result = registration::insert($formData);

        if ($result == true) {
            return "Registration Success";
        }
        else{
            return "Registration Fail !";
        }

    }




  }
}
