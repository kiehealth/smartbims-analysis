<?php

namespace App\Imports;

use App\Models\Kit;
use App\Models\Order;
use App\Models\Sample;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use ErrorException;

class KitsImport implements ToCollection, WithHeadingRow, SkipsOnFailure, WithMapping
{
    use SkipsFailures;
    
    
    private $rows = 0; // no. of rows count processed;
    private $wasRecentlyCreated = 0; // no. of rows count inserted;
    
    
    
    public function collection(Collection $rows)
    {
        $data = $rows->toArray();
        $messages = [];
        //dd($data);
        foreach ($data as $key => $val){
            
            
            $messages["$key.order_id.required"] = __('lang.order_id.required', ['row' => $key+2]);
            /*"Error on row: <strong>".($key+2)."</strong>. The order_id is missing."
                                                  ." The order_id is required.";*/
            /*
            $messages["$key.order_id.unique"] = "Error on row: <strong>".($key+2)."</strong>. The order_id <strong>".(Arr::exists($val, "order_id")?$val['order_id']:"").
                                                 "</strong> seems to have been processed already. ". 
                                                 " Only one kit per order_id.";
            */
            $messages["$key.order_id.exists"] = __('lang.order_id.exists', ['row' => $key+2, 'order_id' => (Arr::exists($val, "order_id")?$val['order_id']:"")]);
            /*"Error on row: <strong>".($key+2)."</strong>. No order with order_id <strong>"
                                                .(Arr::exists($val, "order_id")?$val['order_id']:"")."</strong> found. The order should be placed "
                                                ."before registering a kit.";*/
            
            $messages["$key.order_id.distinct"] = __('lang.order_id.distinct', ['row' => $key+2, 'order_id' => (Arr::exists($val, "order_id")?$val['order_id']:"")]);
            /*"Error on row: <strong>".($key+2)."</strong>. The order_id <strong>".(Arr::exists($val, "order_id")?$val['order_id']:"").
                                                  "</strong> has a duplicate value. ".
                                                  " The order_id must be unique.";*/
            
            
            
            $messages["$key.sample_id.required_with"] = __('lang.sample_id.required_with', ['row' => $key+2]);
            /*"Error on row: <strong>".($key+2)."</strong>. The sample_id is missing."
                                                  ." The sample_id is required when the sample_received_date is present.";*/
            /*
            $messages["$key.sample_id.unique"] = "Error on row: <strong>".($key+2).
                                                 "</strong>. The sample_id <strong>".(Arr::exists($val, "sample_id")?$val['sample_id']:"").
                                                 "</strong> has already been registered. The sample_id must be unique.";
            */
            
            $messages["$key.sample_id.distinct"] = __('lang.sample_id.distinct', ['row' => $key+2, 'sample_id' => (Arr::exists($val, "sample_id")?$val['sample_id']:"")]);
            /*"Error on row: <strong>".($key+2)."</strong>. The sample_id <strong>".(Arr::exists($val, "sample_id")?$val['sample_id']:"").
                                                   "</strong> has a duplicate value. ".
                                                   " The sample_id must be unique.";*/

            
            $messages["$key.barcode.unique"] = __('lang.barcode.unique', ['row' => $key+2, 'barcode' => (Arr::exists($val, "barcode")?$val['barcode']:"")]);
            /*"Error on row: <strong>".($key+2).
                                               "</strong>. The barcode <strong>".(Arr::exists($val, "barcode")?$val['barcode']:"").
                                               "</strong> has already been registered. The barcode must be unique.";*/
           
            $messages["$key.barcode.distinct"] = __('lang.barcode.distinct', ['row' => $key+2, 'barcode' => (Arr::exists($val, "barcode")?$val['barcode']:"")]);
            /*"Error on row: <strong>".($key+2)."</strong>. The barcode <strong>".(Arr::exists($val, "barcode")?$val['barcode']:"").
                                                 "</strong> has a duplicate value. ".
                                                 " The barcode must be unique.";*/
            
            
            
            $messages["$key.kit_dispatched_date.required"] = __('lang.kit_dispatched_date.required', ['row' => $key+2]);
            /*"Error on row: <strong>".($key+2)."</strong>. The kit_dispatched_date is missing.".
                                                             " Please put the date when the kit is going to be dispatched.";*/
           
           
            $messages["$key.kit_dispatched_date.date"] = __('lang.kit_dispatched_date.date', ['row' => $key+2, 'kit_dispatched_date' => (Arr::exists($val, "kit_dispatched_date")?$val['kit_dispatched_date']:"")]);
            /*"Error on row: <strong>".($key+2).
                                                         "</strong>. The kit_dispatched_date <strong>".(Arr::exists($val, "kit_dispatched_date")?$val['kit_dispatched_date']:"").
                                                         "</strong> is not a valid date. Please input a valid date (yyyy-mm-dd).";*/
            
           
            $messages["$key.sample_received_date.date"] = __('lang.sample_received_date.date', ['row' => $key+2, 'sample_received_date' => (Arr::exists($val, "sample_received_date")?$val['sample_received_date']:"")]);
            /*"Error on row: <strong>".($key+2).
                                                          "</strong> The sample_received_date <strong>".(Arr::exists($val, "sample_received_date")?$val['sample_received_date']:"").
                                                          "</strong> is not a valid date. Please input a valid date (yyyy-mm-dd).";*/
           
            $messages["$key.sample_received_date.required_with"] = __('lang.sample_received_date.required_with', ['row' => $key+2]);
            /*"Error on row: <strong>".($key+2)."</strong>. The sample_received_date is missing."
                                                                   ." The sample_received_date is required when the sample_id is present.";*/
            
            $messages["$key.sample_received_date.after_or_equal"] = __('lang.sample_received_date.after_or_equal', ['row' => $key+2, 'sample_received_date' => (Arr::exists($val, "sample_received_date")?$val['sample_received_date']:"")
                                                                    , 'kit_dispatched_date' => (Arr::exists($val, "kit_dispatched_date")?$val['kit_dispatched_date']:"")]);
            /*"Error on row: <strong>".($key+2).
                                                                    "</strong> The sample_received_date <strong>".(Arr::exists($val, "sample_received_date")?$val['sample_received_date']:"").
                                                                    "</strong> must be a date after or equal to kit_dispatched_date <strong>"
                                                                    .(Arr::exists($val, "kit_dispatched_date")?$val['kit_dispatched_date']:"")."</strong>.";*/
           
           
        }
        
        $validator = Validator::make($data, [
            '*.order_id' => ['required', 
                             //'unique:kits,order_id', //For existing order_id perform update
                             'exists:orders,id',
                             'distinct',
                            ],
            '*.sample_id' => ['sometimes', 'nullable', 'required_with:'.'*.sample_received_date', 'distinct' /*,'unique:kits,sample_id'*/ ],
            '*.barcode' => ['sometimes', 'nullable', 'unique:kits,barcode', 'distinct'],
            '*.kit_dispatched_date' => ['required', 'date'],
            '*.sample_received_date' => ['sometimes', 'nullable', 'date', 'required_with:'.'*.sample_id', 'after_or_equal:*.kit_dispatched_date'],
            
        ], $messages)->validate(); 
        
        
        
        
        
        foreach ($data as $row) {
            ++$this->rows;
            $kit = Kit::updateOrCreate(
                ['order_id' => $row['order_id']],
                ['user_id' => Order::find($row['order_id'])->user->id,
                'sample_id' => empty($row['sample_id'])?$row['order_id']:$row['sample_id'],
                'barcode' => $row['barcode'],
                'kit_dispatched_date' => $row['kit_dispatched_date'],
                'sample_received_date' => $row['sample_received_date'],
                ]
            );
             
            if($kit->wasRecentlyCreated){
                ++$this->wasRecentlyCreated;
            }
                
            if(!empty($row['sample_id'] && $row['sample_received_date'])){
                $sample = Sample::updateOrCreate(
                    ['kit_id' => $kit->id],
                    ['sample_id' => $row['sample_id'], 'sample_registered_date' =>$row['sample_received_date']]
                );
                
                if($sample->reporting_date){
                    $sample->kit->order->update(['status' => config('constants.results.RESULT_RECEIVED')]);
                }
                elseif ($sample->sample_registered_date){
                    $sample->kit->order->update(['status' => config('constants.samples.SAMPLE_REGISTERED')]);
                }
                continue;
                
            }
                
            if($kit->sample_received_date){
                $kit->order->update(['status' => config('constants.samples.SAMPLE_RECEIVED')]);
            }
            else{
                Order::find($row['order_id'])->update(['status' => config('constants.kits.KIT_DISPATCHED')]);
            }
            
        }
        
        
        
       
        
    }
    
    
    
    public function getRowCount(): int
    {
        return $this->rows;
    }
    

    public function getInsertedRowCount(): int
    {
        return $this->wasRecentlyCreated;
    }
    
    public function getUpdatedRowCount(): int
    {
        return ($this->rows-$this->wasRecentlyCreated);
    }
   
    
    
    public function map($row): array
    {
        
        try{
            
            if(gettype($row['kit_dispatched_date']) == 'integer' || gettype($row['kit_dispatched_date']) == 'double'){
                $row['kit_dispatched_date'] = Date::excelToDateTimeObject($row['kit_dispatched_date'])->format('Y-m-d');
            }
            
            if(gettype($row['sample_received_date']) == 'integer' || gettype($row['sample_received_date']) == 'double'){
                $row['sample_received_date'] = Date::excelToDateTimeObject($row['sample_received_date'])->format('Y-m-d');
            }
            
        }
        catch (ErrorException $e){
            
            //dd($e);
        }
        //dd($row);
        return $row;
        
    }


}
