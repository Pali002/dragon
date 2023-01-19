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
use App\Http\Resources\Color as ColorResource;

class ColorController extends BaseController{

    public function update(Request $request, $id) {
        $input = $request->all();

        $validator = Validator::make($input, [
            "color" => "required"
        ]);

        if($validator->fails()) {
            return $this->sendError($validator-errors());
        }

        $color = Color::find($id);
        $color->update($request->all());

        return $this->sendResponse(new ColorResource($color), "Post frissitve");
    }
}
