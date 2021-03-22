<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
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
        
        if($filter_criteria == 'orders'){
            $query_results = User::has('orders')
                            ->when($pnr, function($query) use( $pnr){
                                $query->where('users.pnr', 'like', '%'.$pnr.'%');
                            })
                            ->with(array('orders' => function($query) use($from_date, $to_date){
                                $query->select('id', 'user_id','status', 'order_created_by', 'created_at');
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
                        $results[$index]['order_id'] = $v['id'];
                        $results[$index]['first_name'] = $value['first_name'];
                        $results[$index]['last_name'] = $value['last_name'];
                        $results[$index]['pnr'] = $value['pnr'];
                        $results[$index]['status'] = $v['status'];
                        $results[$index]['order_created_by'] = $v['order_created_by'];
                        $results[$index]['created_at'] = Carbon::parse($v['created_at'])->format('Y-m-d');
                        
                        $index++;
                    }
                    
                }
            }
            $query_title = "Total Orders ".($request->filled('pnr')?"for $request->pnr ":"").
                            (($request->filled('from_date') && $request->filled('to_date'))?"between $request->from_date and $request->to_date":"").
                            (($request->filled('from_date') && !$request->filled('to_date'))?"from $request->from_date till ".Carbon::now()->format('Y-m-d'):"").
                            ((!$request->filled('from_date') && $request->filled('to_date'))?"until $request->to_date":"");
            //return $results;
            return response()->json(array('data'=> $results,  
                'query_title' => $query_title ,'columns' =>['Order ID', 'First Name', 'Last Name', 'PNR', 'Status', 'Order Created By', 'Created At']));
        }
        
        
        if($filter_criteria == 'without_orders'){
            $results = User::doesntHave('orders')
                                ->when($pnr, function($query) use( $pnr){
                                    $query->where('users.pnr', 'like', '%'.$pnr.'%');
                                })
                                ->get(['id','first_name','last_name','pnr', 'phonenumber']);
                                
            $query_title = "Users without any orders";
            
            return response()->json(array('data'=> $results,
                'query_title' => $query_title ,'columns' =>['User ID', 'First Name', 'Last Name', 'PNR', 'Phonenumber']));
            
            
        }
        
        
        
    }
}
