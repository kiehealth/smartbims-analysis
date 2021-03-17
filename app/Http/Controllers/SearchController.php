<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        //dd($request);
        
        $columns = array();
        $results = array();
       
        $pnr = $request->input('pnr');
        $filter_criteria = $request->input('filter_criteria');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        
        if($filter_criteria=='orders'){
            $results = Order::with('user:id,first_name,last_name,pnr')
            ->when($pnr, function($query, $pnr){
                 $query->wherehas('user', function($query) use( $pnr){
                     $query->where('pnr', 'like', '%'.$pnr.'%');
                });
            })
            ->when(($from_date && $to_date), function($query) use( $from_date, $to_date){
                $query->whereBetween('created_at', [$from_date, $to_date]);
            })
            ->when(($from_date && !$to_date), function($query) use ($from_date){
                $query->whereDate('created_at', '>=', $from_date);
            })
            ->when((!$from_date && $to_date), function($query) use( $to_date){
                $query->whereDate('created_at', '<=', $to_date);
            })
            ->get(['user_id','status','created_at']);
           /* 
            $results = $results->map(function($item){
                return $item->user_id;
            });
            $results = $results->map(function($item){
                return $item->forget('user_id');
            });
            */
            
            
            
            
            
            
            $results_array = json_decode($results, true);
            foreach ($results_array as $key => $value){
                unset($results_array[$key]['user_id']);
            }
            
            $results = json_encode($results_array);
            
            //return $results;
            
            return response()->json(array('data'=> $results,  'columns' =>['Status']));
        }
        
        /*
        $results = User::when($pnr, function($query, $pnr){
            return $query->where('pnr', 'like', '%'.$pnr.'%');
        });
        
        if($request->has("model") and isset($request->model)){
            $results = DB::table('users')
            ->when($pnr, function($query, $pnr){
                return $query->where('pnr', 'like', '%'.$pnr.'%');
            })
            ->get('pnr');
            //return response()->json(array('data'=> $results,  'columns' =>['PNR']) );
            
        }*/
        
        
        //return Order::with('user:id,first_name')->get(['user_id','status','created_at']);
        //return User::with('orders:id,user_id')->get();
        
       // $results = User::select('first_name', 'last_name', 'pnr', 'country')->get();
        $orders = User::with('orders:id,user_id')->get();
        //dd($orders->map(function($order){$order->user_id;}));
        
        /* dd(Order::with('user')->get()->map(function ($order) {
            return $order->user->last_name;
        }));
        dd($results->map(function ($user) {
            return $user->country;
        })); */
        /*
        if($request->has("model") and isset($request->model)){
            $results = User::when($request->get('orders'), function ($query) {
                $query->whereHas('orders');
            })->get(['first_name']);
            dd($results);
           // dump(User::whereRaw('NOT FIND_IN_SET(?, roles)', [config('constants.roles.ADMIN_ROLE')])
           //     ->with('orders')->get()->toJson());
           
            //return response()->json(array('data'=> User::get(["first_name", "last_name"]),  'columns' =>['First Name','Last Name']) );
            
            //return response->json('data', User::get("first_name")->toJson())
            //->with('columns', 'first_name');
            
            
        }
        
            return;
        */
    }
}
