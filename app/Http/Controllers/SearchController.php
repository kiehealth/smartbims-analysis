<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    
    /**
     * Queries to generate different reports.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request){
        DB::connection()->enableQueryLog();
        $query_results = array();
        $results = array();
        
        $pnr = $request->input('pnr');
        $filter_criteria = $request->input('filter_criteria');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        
        
        /** Query to retrieve all orders with provided condition**/
        if($filter_criteria == 'orders'){
            $query_results = User::has('orders')
                            ->when($pnr, function($query) use( $pnr){
                                $query->where('users.pnr', 'like', '%'.$pnr.'%');
                            })
                            ->with(array('orders' => function($query) use($from_date, $to_date){
                                $query->select('id', 'user_id', 'status', 'order_created_by', 'created_at');
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
        
        
        /** Query to retrieve all unprocessed orders with provided condition**/
        if($filter_criteria == "unprocessed_orders"){
            $query_results = User::has('orders')
                            ->when($pnr, function($query) use( $pnr){
                                $query->where('users.pnr', 'like', '%'.$pnr.'%');
                            })
                            ->with(array('orders' => function($query) use($from_date, $to_date){
                                
                                $query->select('id', 'user_id', 'status', 'order_created_by', 'created_at');
                                $query->doesntHave('kit');
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
            
            $query_title = "Unprocessed Orders ".($request->filled('pnr')?"for $request->pnr ":"").
                            (($request->filled('from_date') && $request->filled('to_date'))?"between $request->from_date and $request->to_date":"").
                            (($request->filled('from_date') && !$request->filled('to_date'))?"from $request->from_date till ".Carbon::now()->format('Y-m-d'):"").
                            ((!$request->filled('from_date') && $request->filled('to_date'))?"until $request->to_date":"");
            //return $results;
            return response()->json(array('data'=> $results,
                'query_title' => $query_title ,'columns' =>['Order ID', 'First Name', 'Last Name', 'PNR', 'Status', 'Order Created By', 'Created At']));
            
        }
        
        
        /** Query to retrieve all users without orders with provided condition**/
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
        
        /** Query to retrieve all kits with provided condition**/
        if($filter_criteria == 'kits'){
            $query_results = User::has('kits')
                            ->when($pnr, function($query) use( $pnr){
                                $query->where('users.pnr', 'like', '%'.$pnr.'%');
                            })
                            ->with(array('kits' => function($query) use($from_date, $to_date){
                                $query->select('id', 'order_id', 'user_id', 'sample_id', 'barcode', 'kit_dispatched_date', 'sample_received_date', 'created_at');
                                $query->when(($from_date && $to_date), function($query) use( $from_date, $to_date){
                                    $query->whereBetween(DB::raw('date(kits.created_at)'), [$from_date, $to_date]);
                                })
                                ->when(($from_date && !$to_date), function($query) use( $from_date){
                                    $query->whereDate('kits.created_at', '>=', $from_date);
                                })
                                ->when((!$from_date && $to_date), function($query) use($to_date){
                                    $query->whereDate('kits.created_at', '<=', $to_date);
                                });
                            }))
                            ->get(['id','first_name','last_name','pnr']);
            
            
            
            
            $working_array = json_decode($query_results, true);
            $index = 0;
            foreach ($working_array as $key => $value){
                
                if(array_key_exists("kits", $value)){
                    foreach ($value['kits'] as $k => $v){
                        $results[$index]['kit_id'] = $v['id'];
                        $results[$index]['first_name'] = $value['first_name'];
                        $results[$index]['last_name'] = $value['last_name'];
                        $results[$index]['pnr'] = $value['pnr'];
                        $results[$index]['sample_id'] = $v['sample_id'];
                        $results[$index]['barcode'] = $v['barcode'];
                        $results[$index]['kit_dispatched_date'] = $v['kit_dispatched_date'];
                        $results[$index]['sample_received_date'] = $v['sample_received_date'];
                        $results[$index]['created_at'] = Carbon::parse($v['created_at'])->format('Y-m-d');
                        
                        $index++;
                    }
                    
                }
            }
            $query_title = "Total Kits ".($request->filled('pnr')?"for $request->pnr ":"").
                            (($request->filled('from_date') && $request->filled('to_date'))?"between $request->from_date and $request->to_date":"").
                            (($request->filled('from_date') && !$request->filled('to_date'))?"from $request->from_date till ".Carbon::now()->format('Y-m-d'):"").
                            ((!$request->filled('from_date') && $request->filled('to_date'))?"until $request->to_date":"");
            
            return response()->json(array('data'=> $results,
                'query_title' => $query_title ,'columns' =>['Kit ID', 'First Name', 'Last Name', 'PNR', 'Sample ID', 'Barcode', 'Kit Dispatched Date', 'Sample Received Date', 'Created At']));
        }
        
        
        /** Query to retrieve all dispatched kits with provided condition**/
        if($filter_criteria == 'kits_dispatched'){
            $query_results = User::has('kits')
                            ->when($pnr, function($query) use( $pnr){
                                $query->where('users.pnr', 'like', '%'.$pnr.'%');
                            })
                            ->with(array('kits' => function($query) use($from_date, $to_date){
                                $query->select('id', 'order_id', 'user_id', 'sample_id', 'barcode', 'kit_dispatched_date', 'sample_received_date', 'created_at')
                                    ->where(function ($query){
                                        $query->whereNotNull('kit_dispatched_date')
                                          ->orWhereNotNull('sample_received_date')
                                          ->orWhereHas('sample');
                                });
                                $query->when(($from_date && $to_date), function($query) use( $from_date, $to_date){
                                    $query->whereBetween(DB::raw('date(kits.kit_dispatched_date)'), [$from_date, $to_date]);
                                })
                                ->when(($from_date && !$to_date), function($query) use( $from_date){
                                    $query->whereDate('kits.kit_dispatched_date', '>=', $from_date);
                                })
                                ->when((!$from_date && $to_date), function($query) use($to_date){
                                    $query->whereDate('kits.kit_dispatched_date', '<=', $to_date);
                                });
                            }))
                            ->get(['id','first_name','last_name','pnr']);
            
            
            //$queries = DB::getQueryLog();
            //dump($queries);
            
            $working_array = json_decode($query_results, true);
            $index = 0;
            foreach ($working_array as $key => $value){
                
                if(array_key_exists("kits", $value)){
                    foreach ($value['kits'] as $k => $v){
                        $results[$index]['kit_id'] = $v['id'];
                        $results[$index]['first_name'] = $value['first_name'];
                        $results[$index]['last_name'] = $value['last_name'];
                        $results[$index]['pnr'] = $value['pnr'];
                        $results[$index]['sample_id'] = $v['sample_id'];
                        $results[$index]['barcode'] = $v['barcode'];
                        $results[$index]['kit_dispatched_date'] = $v['kit_dispatched_date'];
                        $results[$index]['sample_received_date'] = $v['sample_received_date'];
                        $results[$index]['created_at'] = Carbon::parse($v['created_at'])->format('Y-m-d');
                        
                        $index++;
                    }
                    
                }
            }
            $query_title = "Total Kits Dispatched ".($request->filled('pnr')?"for $request->pnr ":"").
                            (($request->filled('from_date') && $request->filled('to_date'))?"between $request->from_date and $request->to_date":"").
                            (($request->filled('from_date') && !$request->filled('to_date'))?"from $request->from_date till ".Carbon::now()->format('Y-m-d'):"").
                            ((!$request->filled('from_date') && $request->filled('to_date'))?"until $request->to_date":"");
            
            return response()->json(array('data'=> $results,
                'query_title' => $query_title ,'columns' =>['Kit ID', 'First Name', 'Last Name', 'PNR', 'Sample ID', 'Barcode', 'Kit Dispatched Date', 'Sample Received Date', 'Created At']));
        }
        
        
        
        /** Query to retrieve all received kits/samples with provided condition**/
        if($filter_criteria == 'samples_received'){
            $query_results = User::has('kits')
                            ->when($pnr, function($query) use( $pnr){
                                $query->where('users.pnr', 'like', '%'.$pnr.'%');
                            })
                            ->with(array('kits' => function($query) use($from_date, $to_date){
                                $query->select('id', 'order_id', 'user_id', 'sample_id', 'barcode', 'kit_dispatched_date', 'sample_received_date', 'created_at')
                                ->where(function ($query){
                                    $query->orWhereNotNull('sample_received_date')
                                          ->orWhereHas('sample');
                                });
                                    $query->when(($from_date && $to_date), function($query) use( $from_date, $to_date){
                                        $query->whereBetween(DB::raw('date(kits.sample_received_date)'), [$from_date, $to_date]);
                                    })
                                    ->when(($from_date && !$to_date), function($query) use( $from_date){
                                        $query->whereDate('kits.sample_received_date', '>=', $from_date);
                                    })
                                    ->when((!$from_date && $to_date), function($query) use($to_date){
                                        $query->whereDate('kits.sample_received_date', '<=', $to_date);
                                    });
                            }))
                            ->get(['id','first_name','last_name','pnr']);
            
            
            //$queries = DB::getQueryLog();
            //dump($queries);
            
            $working_array = json_decode($query_results, true);
            $index = 0;
            foreach ($working_array as $key => $value){
                
                if(array_key_exists("kits", $value)){
                    foreach ($value['kits'] as $k => $v){
                        $results[$index]['kit_id'] = $v['id'];
                        $results[$index]['first_name'] = $value['first_name'];
                        $results[$index]['last_name'] = $value['last_name'];
                        $results[$index]['pnr'] = $value['pnr'];
                        $results[$index]['sample_id'] = $v['sample_id'];
                        $results[$index]['barcode'] = $v['barcode'];
                        $results[$index]['kit_dispatched_date'] = $v['kit_dispatched_date'];
                        $results[$index]['sample_received_date'] = $v['sample_received_date'];
                        $results[$index]['created_at'] = Carbon::parse($v['created_at'])->format('Y-m-d');
                        
                        $index++;
                    }
                    
                }
            }
            $query_title = "Total Kits/Samples Received ".($request->filled('pnr')?"for $request->pnr ":"").
                            (($request->filled('from_date') && $request->filled('to_date'))?"between $request->from_date and $request->to_date":"").
                            (($request->filled('from_date') && !$request->filled('to_date'))?"from $request->from_date till ".Carbon::now()->format('Y-m-d'):"").
                            ((!$request->filled('from_date') && $request->filled('to_date'))?"until $request->to_date":"");
            
            return response()->json(array('data'=> $results,
                'query_title' => $query_title ,'columns' =>['Kit ID', 'First Name', 'Last Name', 'PNR', 'Sample ID', 'Barcode', 'Kit Dispatched Date', 'Sample Received Date', 'Created At']));
        }
        
        
        
        /** Query to retrieve all samples with provided condition**/
        if($filter_criteria == 'samples'){
            $query_results = User::has('samples')
                                ->when($pnr, function($query) use( $pnr){
                                    $query->where('users.pnr', 'like', '%'.$pnr.'%');
                                })
                                ->with(array('samples' => function($query) use($from_date, $to_date){
                                    $query->select('samples.id', 'kit_id', 'samples.sample_id', 'lab_id', 'sample_registered_date', 'cobas_result', 'cobas_analysis_date', 
                                        'luminex_result', 'luminex_analysis_date', 'rtpcr_result', 'rtpcr_analysis_date', 'final_reporting_result', 'reporting_date', 'reported_via');
                                    
                                    $query->when(($from_date && $to_date), function($query) use( $from_date, $to_date){
                                        $query->whereBetween(DB::raw('date(samples.sample_registered_date)'), [$from_date, $to_date]);
                                    })
                                    ->when(($from_date && !$to_date), function($query) use( $from_date){
                                        $query->whereDate('samples.sample_registered_date', '>=', $from_date);
                                    })
                                    ->when((!$from_date && $to_date), function($query) use($to_date){
                                        $query->whereDate('samples.sample_registered_date', '<=', $to_date);
                                    });
                                }))
                                ->get(['id','first_name','last_name','pnr']);
            
            
            //$queries = DB::getQueryLog();
            //dump($queries);
            
            $working_array = json_decode($query_results, true);
            $index = 0;
            foreach ($working_array as $key => $value){
                
                if(array_key_exists("samples", $value)){
                    foreach ($value['samples'] as $k => $v){
                        $results[$index]['sample_key'] = $v['id'];
                        $results[$index]['sample_id'] = $v['sample_id'];
                        $results[$index]['first_name'] = $value['first_name'];
                        $results[$index]['last_name'] = $value['last_name'];
                        $results[$index]['pnr'] = $value['pnr'];
                        $results[$index]['lab_id'] = $v['lab_id'];
                        $results[$index]['sample_registered_date'] = $v['sample_registered_date'];
                        $results[$index]['cobas_result'] = $v['cobas_result'];
                        $results[$index]['cobas_analysis_date'] = $v['cobas_analysis_date'];
                        $results[$index]['luminex_result'] = $v['luminex_result'];
                        $results[$index]['luminex_analysis_date'] = $v['luminex_analysis_date'];
                        $results[$index]['rtpcr_result'] = $v['rtpcr_result'];
                        $results[$index]['rtpcr_analysis_date'] = $v['rtpcr_analysis_date'];
                        $results[$index]['final_reporting_result'] = $v['final_reporting_result'];
                        $results[$index]['reporting_date'] = $v['reporting_date'];
                        $results[$index]['reported_via'] = $v['reported_via'];
                        
                        $index++;
                    }
                    
                }
            }
            $query_title = "Total Samples Registered ".($request->filled('pnr')?"for $request->pnr ":"").
                            (($request->filled('from_date') && $request->filled('to_date'))?"between $request->from_date and $request->to_date":"").
                            (($request->filled('from_date') && !$request->filled('to_date'))?"from $request->from_date till ".Carbon::now()->format('Y-m-d'):"").
                            ((!$request->filled('from_date') && $request->filled('to_date'))?"until $request->to_date":"");
            
            return response()->json(array('data'=> $results,
                'query_title' => $query_title ,'columns' =>['Sample Key', 'Sample ID', 'First Name', 'Last Name', 'PNR', 'Lab ID', 'Sample Registered Date', 
                    'Cobas Result', 'Cobas Analysis Date', 'Luminex Result', 'Luminex Analysis Date', 'RT PCR Result', 'RT PCR Analysis Date', 'Final Reporting Result', 
                    'Reporting Date', 'Reported Via']));
        }
        
        
        
        /** Query to retrieve all results reported for samples with provided condition**/
        if($filter_criteria == 'results_reported'){
            $query_results = User::has('samples')
                                ->when($pnr, function($query) use( $pnr){
                                    $query->where('users.pnr', 'like', '%'.$pnr.'%');
                                })
                                ->with(array('samples' => function($query) use($from_date, $to_date){
                                    $query->select('samples.id', 'kit_id', 'samples.sample_id', 'lab_id', 'sample_registered_date', 'cobas_result', 'cobas_analysis_date',
                                        'luminex_result', 'luminex_analysis_date', 'rtpcr_result', 'rtpcr_analysis_date', 'final_reporting_result', 'reporting_date', 'reported_via');
                                    $query->whereNotNull('final_reporting_result')
                                           ->whereNotNull('reporting_date');
                                    $query->when(($from_date && $to_date), function($query) use( $from_date, $to_date){
                                        $query->whereBetween(DB::raw('date(samples.reporting_date)'), [$from_date, $to_date]);
                                    })
                                    ->when(($from_date && !$to_date), function($query) use( $from_date){
                                        $query->whereDate('samples.reporting_date', '>=', $from_date);
                                    })
                                    ->when((!$from_date && $to_date), function($query) use($to_date){
                                        $query->whereDate('samples.reporting_date', '<=', $to_date);
                                    });
                                }))
                                ->get(['id','first_name','last_name','pnr']);
            
            
            //$queries = DB::getQueryLog();
            //dump($queries);
            
            $working_array = json_decode($query_results, true);
            $index = 0;
            foreach ($working_array as $key => $value){
                
                if(array_key_exists("samples", $value)){
                    foreach ($value['samples'] as $k => $v){
                        $results[$index]['sample_key'] = $v['id'];
                        $results[$index]['sample_id'] = $v['sample_id'];
                        $results[$index]['first_name'] = $value['first_name'];
                        $results[$index]['last_name'] = $value['last_name'];
                        $results[$index]['pnr'] = $value['pnr'];
                        $results[$index]['lab_id'] = $v['lab_id'];
                        $results[$index]['sample_registered_date'] = $v['sample_registered_date'];
                        $results[$index]['cobas_result'] = $v['cobas_result'];
                        $results[$index]['cobas_analysis_date'] = $v['cobas_analysis_date'];
                        $results[$index]['luminex_result'] = $v['luminex_result'];
                        $results[$index]['luminex_analysis_date'] = $v['luminex_analysis_date'];
                        $results[$index]['rtpcr_result'] = $v['rtpcr_result'];
                        $results[$index]['rtpcr_analysis_date'] = $v['rtpcr_analysis_date'];
                        $results[$index]['final_reporting_result'] = $v['final_reporting_result'];
                        $results[$index]['reporting_date'] = $v['reporting_date'];
                        $results[$index]['reported_via'] = $v['reported_via'];
                        
                        $index++;
                    }
                    
                }
            }
            $query_title = "Total Results Reported ".($request->filled('pnr')?"for $request->pnr ":"").
                            (($request->filled('from_date') && $request->filled('to_date'))?"between $request->from_date and $request->to_date":"").
                            (($request->filled('from_date') && !$request->filled('to_date'))?"from $request->from_date till ".Carbon::now()->format('Y-m-d'):"").
                            ((!$request->filled('from_date') && $request->filled('to_date'))?"until $request->to_date":"");
            
            return response()->json(array('data'=> $results,
                'query_title' => $query_title ,'columns' =>['Sample Key', 'Sample ID', 'First Name', 'Last Name', 'PNR', 'Lab ID', 'Sample Registered Date',
                    'Cobas Result', 'Cobas Analysis Date', 'Luminex Result', 'Luminex Analysis Date', 'RT PCR Result', 'RT PCR Analysis Date', 'Final Reporting Result',
                    'Reporting Date', 'Reported Via']));
        }
        
        
    }
}
