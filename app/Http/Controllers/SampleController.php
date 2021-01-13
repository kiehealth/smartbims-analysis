<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kit;
use App\Models\Sample;

use Carbon\Carbon;

class SampleController extends Controller
{
    //
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $id)
    {
        $kit = Kit::find($id);
        
        $sample = new Sample([
            'kit_id' => $id,
            'sample_id' => $kit->sample_id,
            'sample_registered_date' => Carbon::now()->toDateString()
        ]);
        
        $sample->save();
        
        if(!$kit->sample_received_date){
            $kit->update(['sample_received_date' => Carbon::now()->toDateString()]);
        }
        
        $order = $kit->order;
        $order->update(['status' => config('constants.samples.SAMPLE_REGISTERED')]);
        
        return back()->with("sample_registered", "The sample with sample_id <strong>".$kit->sample_id."</strong> is registered successfully!");
        
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ((Session::get('grandidsession')===null)){
            return  view('admin.login');
        }
        
        return view('admin.samples', ['samples' => Sample::all()]);
        echo 1;
        
    }
    
}
