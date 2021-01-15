<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kit;
use App\Models\Sample;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        
        $sample = Sample::find($id);
        return view('admin.edit_sample', compact('sample'));
        
        
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
        $sample = Sample::find($id);
        $kit_id = $sample->kit->id;
        
        $validator = Validator::make($request->all(),[
            'sample_id'=>'required|unique:kits,sample_id,'.$kit_id.'|unique:samples,sample_id,'.$id,
            'lab_id'=>'sometimes|nullable|unique:samples,lab_id,'.$id,
            'sample_registered_date'=>'sometimes|nullable|date',
            'analysis_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date',
            'rtpcr_analysis_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date',
            'reporting_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date|after_or_equal:analysis_date|required_with:cobas_result,genotyping_result,luminex_result,rtpcr_result',
            //'cobas_result' => 'exclude_unless:reporting_date,true|required'
        ],[
            '*.required_without_all' => "At least one of the cobas result/genotyping result/luminex result/rtpcr result is required
                                          when the reporting date is present."
        ]);
        
        $validator->sometimes('cobas_result', 'required_without_all:genotyping_result,luminex_result,rtpcr_result', function ($input) {
            return !empty($input->reporting_date);
        });
        $validator->sometimes('genotyping_result', 'required_without_all:cobas_result,luminex_result,rtpcr_result', function ($input) {
            return !empty($input->reporting_date);
        });
        $validator->sometimes('luminex_result', 'required_without_all:cobas_result,genotyping_result,rtpcr_result', function ($input) {
            return !empty($input->reporting_date);
        });
        $validator->sometimes('rtpcr_result', 'required_without_all:cobas_result,genotyping_result,luminex_result', function ($input) {
            return !empty($input->reporting_date);
        });
    
        //dd($validator->errors());
        $validator->validate();
        
        
        $sample->kit->update(['sample_id' => $request->sample_id]);
        $sample->update($request->all());
        
        if($request->filled('reporting_date')){
            $sample->kit->order->update(['status' => config('constants.results.RESULT_RECEIVED')]);
        }
        else{
            $sample->kit->order->update(['status' => config('constants.samples.SAMPLE_REGISTERED')]);
        }
        
        return redirect('admin/samples')->with("sample_updated", "The Sample is updated!");
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
        $sample = Sample::find($id);
        
        if($sample->kit->sample_received_date){
            $sample->kit->order->update(['status' => config('constants.samples.SAMPLE_RECEIVED')]);
        }
        elseif($sample->kit->kit_dispatched_date){
            $sample->kit->order->update(['status' => config('constants.kits.KIT_DISPATCHED')]);
        }
        else{
            $sample->kit->order->update(['status' => config('constants.kits.KIT_REGISTERED')]);
        }
        $sample->delete();
        
        return back()->with('sample_deleted', "Sample Deleted!");
        
    }
}
