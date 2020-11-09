<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Personnummer\Personnummer;
use Personnummer\PersonnummerException;
use App\Models\Order;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderController extends Controller
{
    
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $userRepo;
    
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository $userRepo
     * @return  void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //session(['name' => 'suyesh']);
        //print session('name');
        //print_r(session()->all());
        if ((Session::get('grandidsession')===null)){
            return  view('admin.login');
        }
        return view('admin.orders', ['orders' => Order::all()]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //
        $request->validate([
            'pnr'=>'required'
        ]);
      
        
        try {
            Personnummer::valid($request->pnr);
               try {
                   $user = $this->userRepo->getUserbyPNR((new Personnummer($request->pnr))->format(true));
                   if ($user->exists) {
                       $order = new Order([
                           'user_id' => $user->id
                       ]);
                       /*
                        *
                        * Alternatively
                        *
                        * $user->orders()->save($order);
                        *
                        */
                       
                       $order->save();
                       return back()->with('order_created', "Order Received!");
                       //return view('home', ['order_created'=>"Order Received!"]);
                   }
               } catch (ModelNotFoundException $e) {
                   return back()->withError("You cannot order.");
                   //return view('home',['order_not_allowed' => "You cannot order."]);
               }
                
            
        } catch (PersonnummerException $e) {
            return back()->withError('PNR Invalid ' . $request->input('pnr'))->withInput();
        }
        
        //$user = $this->userRepo->getUserbyPNR($request->get('pnr')); 
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Order::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return Order::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'user_id'=>'required',
            'status'=>'required'
        ]);
                
        $order = Order::findOrFail($id);
        $order->update($request->all());
        
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Order::find($id)->delete();
        return back()->with('order_deleted', "Order Deleted!");
        
    }
    
    
    /**
     * Get all orders for this user. 
     *
     *
     * @param  int $id
     * @return \App\Models\Order
     */
    
    public function getAllOrdersforUser($id){
        
        return User::find($id)->orders;
        
    }
}