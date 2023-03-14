<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\User;
use App\Models\Color;
use App\Models\Dragon;
use App\Http\Resources\Dragon as DragonResource;

class DragonController extends BaseController {

    public function store(Request $request) {

        $input = $request->all();
        // $input["color_id"] = DB::table("colors")->where("color", $input["color_id"])->select("id")->first()->id;
        $input["color_id"] = Color::where("color", $input["color_id"])->first()->id;
        $validator = Validator::make( $input, [
            "name" => "required",
            "age" => "required",
            "color_id" => "required"
        ]);

        if( $validator->fails()) {
            return $this->sendError( $validator->errors());
        }
        $dragons = Dragon::create($input);
        return $this->sendResponse(new DragonResource($dragons), "Post létrehozva");
    }

    public function index() {
        $dragons = Dragon::with("color")->get();
        return $this->sendResponse( DragonResource::collection($dragons), "OK");
    }

    public function update(Request $request, $id) {
        $input = $request->all();

        $validator = Validator::make($input, [

            "name" => "required",
            "age" => "required",
            "color_id" => "required"
        ]);

        if( $validator->fails() ) {

            return $this->sendError( $validator->errors());
        }

        $dragon = Dragon::find($id);
        $dragon->update($request->all());

        return $this->sendResponse(new DragonResource($dragon), "Frissítve");
    }

    public function destroy($id) {
        Dragon::destroy($id);

        return $this->sendResponse([], "Post törölve");
    }

    public function show($id) {
        $dragon = Dragon::find($id);
        
        if(is_null($dragon)) {
            return $this->sendError("Post nem létezik");
        }

        return $this->sendResponse( new DragonResource($dragon), "Dragon megjelenitve");
    }
}
