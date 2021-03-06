<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Personnummer\Personnummer;
use Personnummer\PersonnummerException;
use App\Models\Order;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Imports\OrdersImport;

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
        return view('admin.orders', ['orders' => Order::all()]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_order');
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
            'ssn'=>'required'
        ]);
      
        
        
       try {
           $user = $this->userRepo->getUserbySSN($request->ssn);
           if ($user->exists) {
               $order = new Order([
                   'user_id' => $user->id,
                   'order_created_by' => Auth::user()->name
               ]);
               /*
                *
                * Alternatively
                *
                * $user->orders()->save($order);
                *
                */
               
               $order->save();
               $user->update(['consent' => 1]);
               /*
               $order_success_msg = "Din best??llning har tagits emot och den kommer att skickas
                    till din folkbokf??ringsadress om n??gra dagar.
                    Om du vill att den ska skickas till en annan adress eller se
                    status kan du g??ra det genom att logga in p?? <a href=".url('/myprofile').">mina sidor</a>
                    eller kontakta oss p?? hpvcenter@ki.se.";
               */
               $order_success_msg = __('lang.order-success-msg');
               if($request->has('type') && $request->type === "admin"){
                   $order_success_msg_admin = __('lang.order-success-msg-admin', ['ssn' => __('lang.ssn'), 'ssnumber' => $request->ssn]);
                   return redirect('admin/orders')->with('order_created', $order_success_msg_admin);
               }
               return back()->with('order_created', $order_success_msg);
               //return view('home', ['order_created'=>"Order Received!"]);
           }
       } catch (ModelNotFoundException $e) {
           if($request->has('type') && $request->type === "admin"){
               $order_unsuccess_msg_admin = __('lang.order-unsuccess-msg-admin', ['ssn' => __('lang.ssn'), 'ssnumber' => $request->input('ssn')]);
               return back()->withError($order_unsuccess_msg_admin)->withInput();
           }
           return back()->withError("N??got gick fel!");
           //return view('home',['order_not_allowed' => "You cannot order."]);
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
        try{
            Order::find($id)->delete();
            $order_deleted_msg = __('lang.order_deleted_msg');
            return back()->with('order_deleted', $order_deleted_msg);
        }
        catch(\Illuminate\Database\QueryException $e){
            $order_not_deleted_msg = __('lang.order_not_deleted_msg');
            return back()->with('order_not_deleted', $order_not_deleted_msg);
        }
        
    }
    
    
    /**
     * Get all orders for this user. 
     *
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    
    public function getAllOrdersforUser($id){
        
        $myorders =  User::find($id)->orders;
        return view('my_orders', compact('myorders'));
        
    }
    
    public function myorders(){
        return OrderController::getAllOrdersforUser(Auth::user()->id);
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderKit(Request $request){
        $order = new Order([
            'user_id' => $request->user_id,
            'order_created_by' => Auth::user()->name
        ]);
        $order->save();
        User::find($order->user->id)->update(['consent' => 1]);
        
        $order_success_msg = __('lang.order-success-msg');
        return back()->with('order_created', $order_success_msg);
    }
    
    
    /**
     * Show the orderr import form.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('admin.import_orders');
    }
    
    
    /**
     * Import collections in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importOrderSave(Request $request) {
        
        Validator::make($request->all(), [
            'orders_file' => 'required|mimes:xls,xlsx',
        ],
        [
            'required' => "Please provide the import file." ,
            'mimes' => "The import file must be an excel file (.xls/.xlsx). "
        ]
        )->validate();
            
            
            try {
                
                $import = new OrdersImport(new UserRepository);
                
                //In case trait Importable is used in Import Class.
                //$import->import($request->file('users_file'));
                
                //Otherwise use Facade.
                Excel::import($import, $request->file('orders_file'));
                
                if(empty($import->getErrors())){
                    return back()->with('orders_import_success', $import->getRowCount().' Orders have been imported successfully!');
                }
                
                return back()->with(['errors_msg' => $import->getErrors() ]);
            }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                dd($e);
            }
    }
}
