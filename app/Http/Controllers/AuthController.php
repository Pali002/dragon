<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\User;
use App\Models\Color;

class AuthController extends BaseController {
    
    public function signUp( Request $request) {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        if( $validator->fails()) {
            return sendErrord("Error validaton", $validator->errors());
        }

        $input = $request->all();
        $input[ "password" ] = bcrypt($input["password"]);
        $user = User::create($input);
        $success["name"] = $user->name;

        return $this->sendResponse($success, "Sikeres regisztráció");
    }

    public function signIn(Request $request) {
        
        if(Auth::attempt (["email" => $request->email, "password" => $request->password])) {
            $authUser = Auth::user();
            $success[ "token" ] = $authUser->createToken("MyAuthApp")->plainTextToken;
            $success[ "name" ] = $authUser->name;

            return $this->sendResponse($success, "Siker bejelentkezés");
        }else {
            return $this->sendError("Unathorized.".["error" => "Hibás adatok"]);
        }
    }

    public function logOut(Request $request) {

        auth( "sanctum" )->user()->currentAccessToken()->delete();

        return response()->json("Succesfuly logout");
    }
    

    public function color(Request $request) {
        $color = $request->color;
        $red = DB::table("colors")->where("color")->select('id')->find();
        print_r($red);
    }

    public function getColor(Request $request) {
        $color = $request->color;
        
        $red = DB::select("color")->WHERE("color", $colorReq)->SELECT("id")->first();
        $id = $color->id;
        print_r($id);
    }
}
