<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\User;




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
        
        $user_order = array('count_non_admin_users' => $count_non_admin_users,
                            'count_users_with_orders' => $count_users_with_orders
                      );
        //dd($user_order);
        
        
        
        //dd($total_non_admin_users);
        return  view('admin.analytics', $user_order);
    }
}