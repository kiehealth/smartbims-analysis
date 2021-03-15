<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        if ($request->has("model") and isset($request->model)){
           // dump(User::whereRaw('NOT FIND_IN_SET(?, roles)', [config('constants.roles.ADMIN_ROLE')])
           //     ->with('orders')->get()->toJson());
           
            return response()->json(array('data'=> User::get(["first_name", "last_name"]),  'columns' =>['First Name','Last Name']) );
            
            //return response->json('data', User::get("first_name")->toJson())
            //->with('columns', 'first_name');
            
            
        }
            
        
    }
}
