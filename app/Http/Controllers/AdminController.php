<?php 

namespace App\Http\Controllers;




class AdminController extends Controller{
    
    
    public function home() {
        return  view('admin.login');
    }
    
    public function dashboard() {
        /*if ((Session::get('grandidsession')!==null))
        return  view('admin.dashboard');
        else return view('admin.login');*/
        return  view('admin.dashboard');
    }
}