<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kit;
use App\Models\Sample;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SamplesImport;

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
            'sample_registered_date'=>'required|date',
            'analysis_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date',
            'rtpcr_analysis_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date',
            'reporting_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date|after_or_equal:analysis_date|required_with:cobas_result,genotyping_result,luminex_result,rtpcr_result',
        ],[
            'required_without_all' => "At least one of the cobas result / genotyping result / luminex result / rtpcr result is required
                                          when the reporting date is present."
        ]);
        
        $validator->sometimes('result', 'required_without_all:cobas_result,genotyping_result,luminex_result,rtpcr_result', function ($input) {
            return !empty($input->reporting_date);
        });
     
        //dd($validator->errors());
        //dd($validator);
        
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
    
    
    /**
     * Show the sample import form.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        //
        if ((Session::get('grandidsession')===null)){
            return  view('admin.login');
        }
        
        return view('admin.import_samples');
    }
    
    
    /**
     * Import collections in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importSampleSave(Request $request) {
        
        Validator::make($request->all(), [
            'samples_file' => 'required|mimes:xls,xlsx',
        ],
            [
                'required' => "Please provide the import file." ,
                'mimes' => "The import file must be an excel file (.xls/.xlsx). "
            ]
            )->validate();
            
            try {
                
                $import = new SamplesImport() ;
                
                //In case trait Importable is used in Import Class.
                //$import->import($request->file('users_file'));
                
                //Otherwise use Facade.
                Excel::import($import, $request->file('samples_file'));
                
                return back()->with('samples_import_success', '<strong>'.$import->getRowCount().'</strong> Samples have been processed successfully! <br>
                            of which <strong>'.$import->getInsertedRowCount().'</strong> Samples have been inserted and <strong>
                            '.$import->getUpdatedRowCount(). '</strong> Samples have been updated.');
                
                
            }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                dd($e);
            }
            catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $e) {
                //dd($e);
            }
    }
}
