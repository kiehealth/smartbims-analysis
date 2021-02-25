<?php

namespace App\Http\Controllers;



use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use GrandID\Client\BankID;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;


/**
 *  BankID v3 client is written by Svensk E-Identitet Developers
 *  It is to be used only and specifically programmed for our API.
 *  There are three main functions
 *  @method FederatedLogin      ( apiKey, authenticateServiceKey )
 *  @method GetSession          ( apiKey, authenticateServiceKey, sessionId )
 *  @method Logout              ( apiKey, authenticateServiceKey, sessionId )
 *
 *  @param gui
 *  @param callbackUrl
 *  @param personalNumber
 *  @param mobileBankid
 *  @param deviceChoice
 *  @param thisDevice
 *  @param askForSSN
 *  @param userVisibleData
 *  @param userNonVisibleData
 *  @param customerURL
 */

class BankIDController extends Controller
{
    protected $bankid;
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $userRepo;
    
    public function __construct(BankID $bankid, UserRepository $userRepo)
    {
        $this->bankid = $bankid;
        $this->userRepo = $userRepo;
    }
    
    public function bankidlogin(Request $request){
        
        //$bankid = new BankID($env = "production");
        // set parameters
        
        //$bankid->callbackUrl = base64_encode(env('BANK_ID_API_CALLBACK_URL'));
        //$bankid->customerURL = base64_encode(env('BANK_ID_API_CUSTOMER_URL'));
        
        $this->bankid->gui = true;
        $this->bankid->callbackUrl = base64_encode(action('BankIDController@bankidauthenticate', 
            ['type' => $request->type, 'url' => url()->previous()]));
        //$this->bankid->customerURL = base64_encode(env('BANK_ID_API_CUSTOMER_URL'));
        $this->bankid->customerURL = base64_encode(url()->previous());
        /**
         * @method getRedirect()
         * @method getSessionId()
         * @return \GrandID\Client\Response
         *
         */
        $response = $this->bankid->FederatedLogin(env('BANK_ID_API_KEY'), env('BANK_ID_API_AUTHENTICATE_SERVICE_KEY')); // string
        $sessionId = $response->getSessionId();
        $redirectUrl = $response->getRedirect();
        
        return redirect($redirectUrl);
        
        //echo $request->type;
        //return json_encode(compact('sessionId', 'redirectUrl'));
       /* echo'<pre>';
        print_r($response);
        //return compact($response->getSessionId(),$response->getRedirect());
        
        $method = "POST";
        
        $urltocall = env('BANK_ID_API_BASE_URL').'FederatedLogin?apiKey='.env('BANK_ID_API_KEY').
                    '&authenticateServiceKey='.env('BANK_ID_API_AUTHENTICATE_SERVICE_KEY');
        
        
        
        parse_str('personalNumber=&callbackUrl='.base64_encode(env('BANK_ID_API_CALLBACK_URL')).
            '&customerURL='.base64_encode(env('BANK_ID_API_CUSTOMER_URL')).
            '&userVisibleData=&thisDevice=false&deviceChoice=&mobileBankId=false&userNonVisibleData=&gui=true&askForSSN='
            , $data_array);
            
        parse_str('personalNumber=&customerURL='.base64_encode(env('BANK_ID_API_CUSTOMER_URL')).
            '&userVisibleData=&thisDevice=false&deviceChoice=&mobileBankId=false&userNonVisibleData=&gui=true&askForSSN='
            , $data_array);
        */
        //return BankIDController::CallAPI('POST', $urltocall, $data_array);
        
        
    }
    
    
    public function bankidauthenticate(Request $request) {
        /**
         *  Is called after Federated Login
         * @param string $apiKey
         * @param string @serviceKey
         * @param string @sessionId
         * @method getUsername()
         * @method getUserAttributes()
         * @method getSessionId()
         * @return \GrandID\Client\Response
         */
        
        try {
            
            $response = $this->bankid->GetSession(env('BANK_ID_API_KEY'),
                env('BANK_ID_API_AUTHENTICATE_SERVICE_KEY'),
                $request->grandidsession);
            
            /**
             > $attributes = $response->getUserAttributes();
             > $sessionId = $response->getSessionId(); // returns the sessionid
             > $username = $response->getUsername(); // username
             >*/
            
            
            if(!empty($response->getUserAttributes()) && 
                $response->getSessionStatus()['code']==="AUTHENTICATED"){
                $user = $this->userRepo->getUserbyPNR($response->getUserAttributes()['personalNumber']);
                
                if($request->has('type') && $request->type === "admin"){// admin login
                    if(stristr($user->roles, config('constants.roles.ADMIN_ROLE')) !== FALSE) {// is admin
                       
                       $request->session()->put("userattributes", $response->getUserAttributes());
                       $request->session()->put("grandidsession", $request->grandidsession);
                       $request->session()->put("role", config('constants.roles.ADMIN_ROLE'));
                       //Session::put("userattributes",json_encode($response->getUserAttributes()));
                       
                       //Route::view('/admin/dashboard', 'admin.dashboard');
                       return redirect('admin/dashboard');
                    }
                    //not admin
                    return redirect('admin')->with('msg', 'You don\'t have admin rights!');
                }
                else{// user login
                    
                    $request->session()->put("userattributes", $response->getUserAttributes());
                    $request->session()->put("grandidsession", $request->grandidsession);
                    $request->session()->put("role", config('constants.roles.USER_ROLE'));
                    $request->session()->put("user_id", $user->id);
                    
                    return redirect($request->has('url')?$request->url:'/');
                }
               
                
                //print_r($response->getUserAttributes()['personalNumber']);
                //echo(json_encode($response->getUserAttributes()));
            }
            else{
                if ($request->type === "admin") return  redirect('admin');
                else return redirect($request->has('url')?$request->url:'/');
            }
        } catch (\ErrorException $e) {
            //dd($e);
            if ($request->type === "admin") return  redirect('admin');
            else return redirect($request->has('url')?$request->url:'/');
        } catch (ModelNotFoundException $e){
            if ($request->type === "admin") return redirect('admin');
            else return redirect($request->has('url')?$request->url:'/')->with('user_not_found', "Något gick fel!");
        }
        
    }
    
    
    public function bankidlogout(Request $request){
        $request->session()->forget(['userattributes', 'grandidsession', 'role', 'user_id']);
        if($this->bankid->Logout(env('BANK_ID_API_KEY'),
            env('BANK_ID_API_AUTHENTICATE_SERVICE_KEY'),
            $request->sessionId)){
            if ($request->type === "admin") return  redirect('admin');
            else return redirect($request->has('url')?$request->url:'/');
            
        }
        if ($request->type === "admin") return  redirect('admin');
        else return redirect($request->has('url')?$request->url:'/');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }
    
    private static function CallAPI($method, $url, $data = false, $headers = false){
        $curl = curl_init();
        
        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                    
        }
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        
        $result = curl_exec($curl);
        
        
        curl_close($curl);
        
        return $result;
    }
}
