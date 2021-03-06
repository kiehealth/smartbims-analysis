<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Kit;
use App\Models\Sample;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SamplesImport;

class SampleController extends Controller
{
    //
    
    /**
     * Show the form for registering the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function registerSample($id)
    {
        $kit = Kit::find($id);
        return view('admin.register_sample', compact('kit'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $id)
    {
        
        $request->validate([
            'sample_id'=>'required|unique:samples,sample_id',
            'sample_registered_date'=>'required|date'
        ]);
        
        $kit = Kit::find($id);
        $kit->update(['sample_id' => $request->sample_id]);
        
        $sample = new Sample([
            'kit_id' => $id,
            'sample_id' => $request->sample_id,
            'sample_registered_date' => $request->sample_registered_date
        ]);
        
        $sample->save();
        
        if(!$kit->sample_received_date){
            //$kit->update(['sample_received_date' => Carbon::now()->toDateString()]);
            $kit->update(['sample_received_date' => $sample->sample_registered_date]);
        }
        
        $order = $kit->order;
        $order->update(['status' => config('constants.samples.SAMPLE_REGISTERED')]);
        
        $sample_registered_msg = __('lang.sample_registered_msg', ['sample_id' => $kit->sample_id]);
        return redirect('admin/kits')->with("sample_registered", $sample_registered_msg);
        
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.samples', ['samples' => Sample::all()]);
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    {//dd($request);
        $sample = Sample::find($id);
        $kit_id = $sample->kit->id;
        
        $validator = Validator::make($request->all(),[
            'sample_id'=>'required|unique:kits,sample_id,'.$kit_id.'|unique:samples,sample_id,'.$id,
            'lab_id'=>'sometimes|nullable|unique:samples,lab_id,'.$id,
            'sample_registered_date'=>'required|date',
            'cobas_analysis_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date',
            'luminex_analysis_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date',
            'rtpcr_analysis_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date',
            'final_reporting_result'=>'sometimes|nullable|required_with:reporting_date',
            'reporting_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date|required_with:final_reporting_result',
        ]/* Remove custom message for required_without_all sincee it is not used.
        ,[
            'required_without_all' => "The final reporting result is required when the reporting date is present."
        ]*/);
        
        /*
         * Complex conditional validation rule removed for lab-workflow.
        $validator->sometimes('result', 'required_without_all:cobas_result,final_reporting_result,luminex_result,rtpcr_result', function ($input) {
            return !empty($input->reporting_date);
        });
        */
     
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
        
        $sample_updated_msg = __('lang.sample_updated_msg');
        return redirect('admin/samples')->with("sample_updated", $sample_updated_msg);
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
        $sample->delete();
        
        if($sample->kit->sample_received_date){
            $sample->kit->order->update(['status' => config('constants.samples.SAMPLE_RECEIVED')]);
        }
        elseif($sample->kit->kit_dispatched_date){
            $sample->kit->order->update(['status' => config('constants.kits.KIT_DISPATCHED')]);
        }
        else{
            $sample->kit->order->update(['status' => config('constants.kits.KIT_REGISTERED')]);
        }
        
        $sample_deleted_msg = __('lang.sample_deleted_msg');
        return back()->with('sample_deleted', $sample_deleted_msg);
        
    }
    
    
    /**
     * Show the sample import form.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
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
                
                $samples_import_success_msg = __('lang.samples_import_success_msg', ['total' => $import->getRowCount(), 'insert' => $import->getInsertedRowCount(), 'update' => $import->getUpdatedRowCount()]);
                return back()->with('samples_import_success', $samples_import_success_msg);
                /*return back()->with('samples_import_success', '<strong>'.$import->getRowCount().'</strong> Samples have been processed successfully! <br>
                            of which <strong>'.$import->getInsertedRowCount().'</strong> Samples have been inserted and <strong>
                            '.$import->getUpdatedRowCount(). '</strong> Samples have been updated.');*/
                
                
            }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                dd($e);
            }
            catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $e) {
                //dd($e);
            }
    }
    
    
    
    public function myresults(){
        return SampleController::getAllResultsforUser(Auth::user()->id);
    }
    
    
    /**
     * Get all results for this user.
     *
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    
    public function getAllResultsforUser($id){
        
        $user = User::find($id);
        $myresults = $user->samples->whereNotNull('final_reporting_result');
        return view('my_results', compact('myresults'));
        
    }
}
