<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Kit;

class KitController extends Controller
{
    
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
        return view('admin.kits', ['kits' => Kit::all()]);
        
    }
    
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
        
        $kit = Kit::find($id);
        return view('admin.edit_register_kit', compact('kit'));
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
        
        $request->validate([
            'sample_id'=>'required|unique:kits,sample_id,'.$id,
            'barcode'=>'sometimes|nullable|unique:kits,barcode,'.$id,
            'kit_dispatched_date'=>'sometimes|nullable|date'
        ]);
        
        $kit = Kit::find($id);
       
        $kit->update($request->all());
        
        if($request->filled('kit_dispatched_date')){
            $kit->order->update(['status' => config('constants.kits.KIT_DISPATCHED')]);
        }
        else{
            $kit->order->update(['status' => config('constants.kits.KIT_REGISTERED')]);
        }
        
        return redirect('admin/orders')->with("kit_updated", "The Kit is updated for the order!");
        
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
        $kit = Kit::find($id);
        $kit->order->update(['status' => config('constants.orders.ORDER_CREATED')]);
        $kit->delete();
        return back()->with('kit_deleted', "Kit Deleted!");
        
    }
}
