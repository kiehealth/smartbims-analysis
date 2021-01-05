<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Order;
use App\Models\Kit;
use App\Imports\KitsImport;

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
        
        $order->update(['status' => config('constants.kits.KIT_REGISTERED')]);
        
        if($request->filled('kit_dispatched_date')){
            $order->update(['status' => config('constants.kits.KIT_DISPATCHED')]);
        }
        
        
        
        return redirect('admin/orders')->with("kit_registered", "The Kit is registered for the order!");
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $type = null)
    {
        //
        if ((Session::get('grandidsession')===null)){
            return  view('admin.login');
        }
        
        $kit = Kit::find($id);
        
        if($type === "kits"){
            return view('admin.edit_kit', compact('kit'));
        }
        
        return view('admin.edit_register_kit', compact('kit'));
    }
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type=null)
    {
        
        $request->validate([
            'sample_id'=>'required|unique:kits,sample_id,'.$id,
            'barcode'=>'sometimes|nullable|unique:kits,barcode,'.$id,
            'kit_dispatched_date'=>'sometimes|nullable|date',
            'sample_received_date'=>'sometimes|nullable|date|after_or_equal:kit_dispatched_date'
        ]);
        
        $kit = Kit::find($id);
       
        $kit->update($request->all());
        
        
        
        if($request->filled('sample_received_date')){
            $kit->order->update(['status' => config('constants.samples.SAMPLE_RECEIVED')]);
        }
        elseif($request->filled('kit_dispatched_date')){
            $kit->order->update(['status' => config('constants.kits.KIT_DISPATCHED')]);
        }
        else{
            $kit->order->update(['status' => config('constants.kits.KIT_REGISTERED')]);
        }
        
        
        
        if($type === "kits"){
            return redirect('admin/kits')->with("kit_updated", "The Kit is updated!");
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
    
    
    /**
     * Show the user import form.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        //
        if ((Session::get('grandidsession')===null)){
            return  view('admin.login');
        }
        
        return view('admin.import_kits');
    }
    
    
    public function importKitSave(Request $request) {
        
        Validator::make($request->all(), [
                'kits_file' => 'required|mimes:xls,xlsx',
            ],
            [
                'required' => "Please provide the import file." ,
                'mimes' => "The import file must be an excel file (.xls/.xlsx). "
            ]
        )->validate();
        
        try {
            
            $import = new KitsImport();
            
            //In case trait Importable is used in Import Class.
            //$import->import($request->file('users_file'));
            
            //Otherwise use Facade.
            Excel::import($import, $request->file('kits_file'));
            
            return back()->with('kits_import_success', $import->getRowCount().' Kits have been imported successfully!');
            
            
        }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            dd($e);
        }
        catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $e) {
            //dd($e);
        }
    }
}
