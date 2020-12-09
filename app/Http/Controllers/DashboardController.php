<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Order;
use App\Models\Kit;




class DashboardController extends Controller{
    
    
    public function home() {
        if ((Session::get('grandidsession')===null)){
            return  view('admin.login');
        }
        return  redirect('admin/dashboard');
    }
    
    public function dashboard() {
        /*if ((Session::get('grandidsession')!==null))
        return  view('admin.dashboard');
        else return view('admin.login');*/
        
        $admin_role = config('constants.roles.ADMIN_ROLE');
        $count_non_admin_users = User::whereRaw('NOT FIND_IN_SET(?, roles)', [$admin_role])->count();
        $count_users_with_orders = User::has('orders')->count();
        

        $count_total_orders = Order::count();
        $status_order_created = config('constants.orders.ORDER_CREATED');
        $count_unprocessed_orders = Order::whereRaw('FIND_IN_SET(?, status)', [$status_order_created])->count();
        
        
        $count_total_kits = Kit::count();
        $status_kit_registered = config('constants.kits.KIT_REGISTERED');
        $status_kit_dispatched = config('constants.kits.KIT_DISPATCHED');
        $status_sample_received = config('constants.samples.SAMPLE_RECEIVED');
        $count_registered_kits = Order::whereRaw('FIND_IN_SET(?, status)', [$status_kit_registered])->count();
        $count_dispatched_kits = Order::whereRaw('FIND_IN_SET(?, status)', [$status_kit_dispatched])->count();
        $count_received_samples = Order::whereRaw('FIND_IN_SET(?, status)', [$status_sample_received])->count();
        
        
        $analytics_data = array('count_non_admin_users' => $count_non_admin_users,
                                'count_users_with_orders' => $count_users_with_orders,
                                'count_total_orders' => $count_total_orders,
                                'count_unprocessed_orders' => $count_unprocessed_orders,
                                'count_total_kits' => $count_total_kits,
                                'count_registered_kits' => $count_registered_kits,
                                'count_dispatched_kits' => $count_dispatched_kits,
                                'count_received_samples' => $count_received_samples
        );
        
        //dd($analytics_data);
        return  view('admin.analytics', $analytics_data);
    }
}