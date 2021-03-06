<?php 

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Models\User;
use App\Models\Order;
use App\Models\Kit;
use Illuminate\Support\Facades\Auth;




class DashboardController extends Controller{
    
    
    public function home() {
        if (!Auth::user() || stristr(Auth::user()->roles, config('constants.roles.ADMIN_ROLE')) === FALSE){
            return view('admin.login');
        }
        //return  view('admin.dashboard');
        return redirect('admin/dashboard');
    }
    
    public function dashboard() {
        /*if ((Session::get('grandidsession')!==null))
        return  view('admin.dashboard');
        else return view('admin.login');*/
        
        $count_total_users = User::count();
        $admin_role = config('constants.roles.ADMIN_ROLE');
        $count_non_admin_users = User::whereRaw('NOT FIND_IN_SET(?, roles)', [$admin_role])->count();
        $count_users_with_orders = User::has('orders')->count();
        

        $count_total_orders = Order::count();
        $status_order_created = config('constants.orders.ORDER_CREATED');
        $count_unprocessed_orders = Order::whereRaw('FIND_IN_SET(?, status)', [$status_order_created])->count();
        
        
        $count_total_kits_registered = Kit::count();
        //$status_kit_registered = config('constants.kits.KIT_REGISTERED');
        //$status_kit_dispatched = config('constants.kits.KIT_DISPATCHED');
        //$status_sample_received = config('constants.samples.SAMPLE_RECEIVED');
        //$count_registered_kits = Order::whereRaw('FIND_IN_SET(?, status)', [$status_kit_registered])->count();
        //$count_dispatched_kits = Order::whereRaw('FIND_IN_SET(?, status)', [$status_kit_dispatched])->count();
        //$count_received_samples = Order::whereRaw('FIND_IN_SET(?, status)', [$status_sample_received])->count();
        $count_dispatched_kits = Kit::all()->reject(function($kit){
            return empty($kit->kit_dispatched_date);
        })->count();
        $count_received_samples = Kit::all()->reject(function($kit){
            return empty($kit->sample_received_date);
        })->count();
        
        $count_total_samples_registered = Sample::count();
        $count_results_received = Sample::all()->reject(function($sample){
            return empty($sample->final_reporting_result && $sample->reporting_date);
        })->count();
        //$status_sample_registered = config('constants.samples.SAMPLE_REGISTERED');
        //$status_result_received = config('constants.results.RESULT_RECEIVED');
        
        
        $analytics_data = array('count_total_users' => $count_total_users,
                                'count_non_admin_users' => $count_non_admin_users,
                                'count_users_with_orders' => $count_users_with_orders,
                                'count_total_orders' => $count_total_orders,
                                'count_unprocessed_orders' => $count_unprocessed_orders,
                                'count_total_kits_registered' => $count_total_kits_registered,
                                //'count_registered_kits' => $count_registered_kits,
                                'count_dispatched_kits' => $count_dispatched_kits,
                                'count_received_samples' => $count_received_samples,
                                'count_total_samples_registered' => $count_total_samples_registered,
                                'count_results_received' => $count_results_received
        );
        
        //dd($analytics_data);
        return  view('admin.analytics', $analytics_data);
    }
}