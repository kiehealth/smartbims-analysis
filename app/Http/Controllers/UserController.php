<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Personnummer\Personnummer;
use Personnummer\PersonnummerException;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Models\Order;
use App\Imports\UsersImport;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
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
    
    
    public function getUserbyPNR($pnr){
        
        return $this->userRepo->getUserbyPNR($pnr);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return User::all();
        return view('admin.users', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if ((Session::get('grandidsession')===null)){
            return  view('admin.login');
        }
           
        return view('admin.create_user');
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
            //Personnummer::valid($request->pnr);
            $user = new User([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'pnr' => (new Personnummer($request->get('pnr')))->format(true),
                'phonenumber' => $request->get('phonenumber'),
                'street' => $request->get('street'),
                'zipcode' => $request->get('zipcode'),
                'city' => $request->get('city'),
                'country' => $request->get('country')
            ]);
            
            $roles = NULL;
            $roles_sep = FALSE;
            if($request->has("user_role")){
                $roles = $request->get('user_role');
                $roles_sep = TRUE;
            }
                
            if($request->has("admin_role")){
                $roles .= ($roles_sep===TRUE)?",".$request->get("admin_role"):"".$request->get("admin_role");
            }
            
            if(!is_null($roles))
                $user->roles = $roles;
            
            
            $user->save();
            
            return redirect('admin/users')->with("user_created", "The user is created!");
        } catch (PersonnummerException $e) {
            //dd($e);
            return back()->withError('PNR Invalid ' . $request->input('pnr'))->withInput();
            
        }
        //return redirect('/users')->with('success', 'User saved!');
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
        return User::find($id);
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
        if ((Session::get('grandidsession')===null)){
            return  view('admin.login');
        }
        
        $user = User::find($id);
        return view('admin.edit_user', compact('user'));
        
        
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
            'pnr'=>'required',
            'user_role'=>'required_without:admin_role',
            ],
            [
                'user_role.required_without' => "One of the USER_ROLE or ADMIN_ROLE should be selected.",
            ]);
        
        try{
            $user = User::find($id);
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->pnr = (new Personnummer($request->get('pnr')))->format(true);
            $user->phonenumber = $request->get('phonenumber');
            $user->street = $request->get('street');
            $user->zipcode = $request->get('zipcode');
            $user->city = $request->get('city');
            $user->country = $request->get('country');
            
            $roles = NULL;
            $roles_sep = FALSE;
            if($request->has("user_role")){
                $roles = $request->get('user_role');
                $roles_sep = TRUE;
            }
            
            if($request->has("admin_role")){
                $roles .= ($roles_sep===TRUE)?",".$request->get("admin_role"):"".$request->get("admin_role");
            }
            
            if(!is_null($roles))
                $user->roles = $roles;

            $user->save();
            
            return redirect('admin/users')->with("user_updated", "The user is updated!");
            
        }
        catch (PersonnummerException $e) {
            return back()->withError('PNR Invalid ' . $request->input('pnr'))->withInput();
        }
        
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
        User::find($id)->delete();
        return back()->with('user_deleted', "User Deleted!");
    }
    /**
     * Get user for this order.
     *
     *
     * @param  int $id
     * @return \App\Models\User
     * 
     */
    
    
    public function getUserforOrder(Order $order){
        
        //return Order::find($id)->user;
        return $order->user()->firstOrFail();
    }
    
    /**
     * Show the user import form.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        //
        if ((Session::get('grandidsession')===null)){
            return view('admin.login');
        }
        
        return view('admin.import_users');
    }
    
    
    public function importUserSave(Request $request) {
        
        Validator::make($request->all(), [
                'users_file' => 'required|mimes:xls,xlsx',
            ],
            [
                'required' => "Please provide the import file." ,
                'mimes' => "The import file must be an excel file (.xls/.xlsx). "
            ]
        )->validate();
        
        
        try {
            
            $import = new UsersImport(new UserRepository);
            
            //In case trait Importable is used in Import Class.
            //$import->import($request->file('users_file'));
            
            //Otherwise use Facade.
            Excel::import($import, $request->file('users_file'));
            
            if(empty($import->getErrors())){
                return back()->with('users_import_success', $import->getRowCount().' Users have been imported successfully!');
            }
            
            return back()->with(['errors_msg' => $import->getErrors() ]);
        }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            dd($e);
        }
    }
    
    
    
    /**
     * Show the user profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile() {
        //dd(session()->all());
        if (UserController::userNotLoggedin()){
            //return redirect()->to('/');
            return view('user_login');
        }
        return redirect()->action([UserController::class, 'myprofile']);
    }
    
    
    
    /**
     * Show the user profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function myprofile(){
        if (UserController::userNotLoggedin()){
                //return redirect()->to('/');
                return view('user_login');
        }
        $user = User::find(session('user_id'));
        return view('profile', compact('user'));
    }
    
    
    /**
     * Check if the user is not logged in.
     *
     * @return boolean
     */
    private function userNotLoggedin(){
        
        if (session()->get('grandidsession')===null || !session()->has('user_id')
            || (session()->get('role')!==config('constants.roles.USER_ROLE'))){
            return true;
        }
        return false;
    }
    
    
    
    /**
     * Update the user profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateprofile(Request $request, $id)
    {
        $user = User::find($id);
        $user->phonenumber = $request->get('phonenumber');
        $user->street = $request->get('street');
        $user->zipcode = $request->get('zipcode');
        $user->city = $request->get('city');
        $user->country = $request->get('country');
        
        $user->save();
        
        return redirect('myprofile')->with("user_profile_updated", "Adress Uppdaterad!");
    }
}
