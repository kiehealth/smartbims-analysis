<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        //DB::connection()->enableQueryLog();
        $query_results = array();
        $results = array();
        
        $pnr = $request->input('pnr');
        $filter_criteria = $request->input('filter_criteria');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        
        if($filter_criteria=='orders'){
            $query_results = User::has('orders')
                            ->when($pnr, function($query) use( $pnr){
                                $query->where('users.pnr', 'like', '%'.$pnr.'%');
                            })
                            ->with(array('orders' => function($query) use($from_date, $to_date){
                                $query->select('user_id','status','created_at');
                                $query->when(($from_date && $to_date), function($query) use( $from_date, $to_date){
                                    $query->whereBetween(DB::raw('date(orders.created_at)'), [$from_date, $to_date]);
                                })
                                ->when(($from_date && !$to_date), function($query) use( $from_date){
                                    $query->whereDate('orders.created_at', '>=', $from_date);
                                })
                                ->when((!$from_date && $to_date), function($query) use($to_date){
                                    $query->whereDate('orders.created_at', '<=', $to_date);
                                });
                            }))
                            ->get(['id','first_name','last_name','pnr']);
            
            
            //$queries = DB::getQueryLog();
            //dump($queries);
            
            $working_array = json_decode($query_results, true);
            $index = 0;
            foreach ($working_array as $key => $value){
                
                if(array_key_exists("orders", $value)){
                    foreach ($value['orders'] as $k => $v){
                        $results[$index]['first_name'] = $value['first_name'];
                        $results[$index]['last_name'] = $value['last_name'];
                        $results[$index]['pnr'] = $value['pnr'];
                        $results[$index]['status'] = $v['status'];
                        $results[$index]['created_at'] = $v['created_at'];
                        
                        $index++;
                    }
                    
                }
            }
            //return $results;
            return response()->json(array('data'=> $results,  'columns' =>['First Name', 'Last Name', 'PNR', 'Status', 'Created At']));
        }
        
        
        
        
        
        
    }
}
