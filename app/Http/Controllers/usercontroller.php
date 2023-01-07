<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;


class usercontroller extends Controller


{
    //
    use HasApiTokens;
    function  register(Request $request){
        $data=$request->validate(
            ['email'=>"required|email " ,

                'password'=>['required','min:8' ]


            ]  );


        $usr=new User;

        $usr->email=$request->get("email");
        $usr->password = Hash::make( $request->get("password")) ;

        $ans=$usr->save();

        if($ans ){

            return response()->json([
                'message' => 'Successfully registered user',
            ]);

        }
        else{
            return response()->json([
                'message' => 'error while creating user ',
            ]);

        }

    }



    function userLogOut(Request $request){

        $request->user()->tokens()->delete();





    }






    /**
     * @throws ValidationException
     */
    function UserLogin(Request $request){

        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $token =   Auth::user()->createToken('Access Token');


            return response()->json([], 200)
                ->header('Authorization', 'Bearer ' . $token->plainTextToken);
        } else {

            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


















}
