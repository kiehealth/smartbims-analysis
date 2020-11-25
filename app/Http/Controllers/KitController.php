<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Kit;

class KitController extends Controller
{
    //
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create($id) {
        $order = Order::find($id);
        return view('admin.register_kit', compact('order'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        
        //
        $request->validate([
            'sample_id'=>'required|unique:kits,sample_id',
            'barcode'=>'sometimes|nullable|unique:kits,barcode',
            'kit_dispatched_date'=>'sometimes|nullable|date' 
        ]);
        
        $order = Order::find($id);
        
        $kit = new Kit([
            'order_id' => $id,
            'user_id' => $order->user->id,
            'sample_id' => $request->get('sample_id'),
            'barcode' => $request->get('barcode'),
            'kit_dispatched_date' => $request->get('kit_dispatched_date')
        ]); 
        
        $kit->save();
        
        if($request->filled('kit_dispatched_date')){
            $order->update(['status' => config('constants.kits.KIT_DISPATCHED')]);
        }
        else{
            $order->update(['status' => config('constants.kits.KIT_REGISTERED')]);
        }
        
        
        
        return redirect('admin/orders')->with("kit_registered", "The Kit is registered for the order!");
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
        
        $user = Kit::find($id);
        return view('admin.edit_user', compact('user'));
        
        
    }
}
