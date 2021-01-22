<?php

namespace App\Imports;

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

class SamplesImport implements ToCollection, WithHeadingRow, SkipsOnFailure, WithMapping
{
    
    use SkipsFailures;
    
    
    private $rows = 0; // no. of rows count inserted;
    
    
    
    
    public function collection(Collection $rows)
    {
        $data = $rows->toArray();
        //dd($data);
        
        $rules = [
            '*.kit_id' => ['required', 'exists:kits,id', 'distinct'],
            '*.sample_id' => ['required', 'exists:kits,sample_id', 'distinct'],
            '*.lab_id' => 'array',
            '*.sample_registered_date'=>'required|date',
            '*.analysis_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date',
            '*.rtpcr_analysis_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date',
            '*.reporting_date'=>'sometimes|nullable|date|after_or_equal:sample_registered_date|after_or_equal:analysis_date|required_with:cobas_result,genotyping_result,luminex_result,rtpcr_result'
        ];
        

        $messages = [];
        
        
        foreach ($data as $key => $val){
            
            $rules = array_merge($rules, [$key.'.lab_id' => ['sometimes', 'nullable', 'distinct', 'unique:samples,lab_id,'.$val['kit_id'].',kit_id']]);
            
            if(!empty($val['reporting_date'])){
                $rules = array_merge($rules, [$key.'.result' =>['required_without_all:'.$key.'.cobas_result,'.$key.'.genotyping_result,'.$key.'.luminex_result,'.$key.'.rtpcr_result']]);
                
                $messages["$key.result.required_without_all"] = "Error on row: <strong>".($key+2)."</strong>. At least one of the cobas result / genotyping result / luminex result / rtpcr result is required
                                          when the reporting date is present.";
            }
            
            
            $messages["$key.kit_id.required"] = "Error on row: <strong>".($key+2)."</strong>. kit_id missing."
                .   " The kit_id is required.";
            
            $messages["$key.kit_id.exists"] = "Error on row: <strong>".($key+2)."</strong>. No kit with kit_id <strong>"
                    .(Arr::exists($val, "kit_id")?$val['kit_id']:"")."</strong> found. The kit should already be registered "
                    ."before importing the sample.";
                        
            $messages["$key.kit_id.distinct"] = "Error on row: <strong>".($key+2)."</strong>. The kit_id <strong>".(Arr::exists($val, "kit_id")?$val['kit_id']:"").
                    "</strong> has a duplicate value. ".
                    " The kit_id must be unique.";
                        
                        
                        
            $messages["$key.sample_id.required"] = "Error on row: <strong>".($key+2)."</strong>. sample_id missing."
                    ." The sample_id is required.";;
            
            $messages["$key.sample_id.exists"] = "Error on row: <strong>".($key+2).
                    "</strong>. No sample with sample_id <strong>".(Arr::exists($val, "sample_id")?$val['sample_id']:"").
                    "</strong> found. The sample_id should be registered before importing the sample.";
                
            $messages["$key.sample_id.distinct"] = "Error on row: <strong>".($key+2)."</strong>. The sample_id <strong>".(Arr::exists($val, "sample_id")?$val['sample_id']:"").
                    "</strong> has a duplicate value. ".
                    " The sample_id must be unique.";
                            
                            
            $messages["$key.sample_registered_date.required"] = "Error on row: <strong>".($key+2)."</strong>. sample_registered_date missing.".
                " sample_registered_date is required.";
                            
                            $messages["$key.barcode.unique"] = "Error on row: <strong>".($key+2).
                            "</strong>. The barcode <strong>".(Arr::exists($val, "barcode")?$val['barcode']:"").
                            "</strong> has already been registered. The barcode must be unique.";
                            
                            $messages["$key.barcode.distinct"] = "Error on row: <strong>".($key+2)."</strong>. The barcode <strong>".(Arr::exists($val, "barcode")?$val['barcode']:"").
                            "</strong> has a duplicate value. ".
                            " The barcode must be unique.";
                            
                            
                            
                            
                            
                            
                            $messages["$key.kit_dispatched_date.date"] = "Error on row: <strong>".($key+2).
                            "</strong>. The kit_dispatched_date <strong>".(Arr::exists($val, "kit_dispatched_date")?$val['kit_dispatched_date']:"").
                            "</strong> is not a valid date. Please input a valid date (yyyy-mm-dd)";
                            
                            /*
                             $messages["$key.sample_received_date.date"] = "Error on row: <strong>".($key+2).
                             "</strong> The sample_received_date <strong>".$val['sample_received_date'].
                             "</strong> is not a valid date. Please input a valid date (yyyy-mm-dd)";
                             
                             $messages["$key.sample_received_date.after_or_equal"] = "Error on row: <strong>".($key+2).
                             "</strong> The sample_received_date <strong>".$val['sample_received_date'].
                             "</strong> must be a date after or equal to kit_dispatched_date <strong>"
                             .$val['kit_dispatched_date']."</strong>.";
                             */
                            
        }
        
        
        $validator = Validator::make($data, $rules, $messages)->validate();
        
        dd($validator);

        /*
         *
         * foreach ($data as $row) {
         * ++$this->rows;
         * Kit::create([
         * 'order_id' => $row['order_id'],
         * 'user_id' => Order::find($row['order_id'])->user->id,
         * 'sample_id' => $row['sample_id'],
         * 'barcode' => $row['barcode'],
         * 'kit_dispatched_date' => $row['kit_dispatched_date'],
         * ]);
         *
         * Order::find($row['order_id'])->update(['status' => config('constants.kits.KIT_DISPATCHED')]);
         * }
         *
         */
    }

    public function map($row): array
    {
        try {

            if (gettype($row['sample_registered_date']) == 'integer' || gettype($row['sample_registered_date']) == 'double'){
                $row['sample_registered_date'] = Date::excelToDateTimeObject($row['sample_registered_date'])->format('Y-m-d');
            }
            
            if(gettype($row['analysis_date']) == 'integer' || gettype($row['analysis_date']) == 'double'){
                $row['analysis_date'] = Date::excelToDateTimeObject($row['analysis_date']);
            }
            
            if (gettype($row['rtpcr_analysis_date']) == 'integer' || gettype($row['rtpcr_analysis_date']) == 'double'){
                $row['rtpcr_analysis_date'] = Date::excelToDateTimeObject($row['rtpcr_analysis_date'])->format('Y-m-d');
            }
            
            if(gettype($row['reporting_date']) == 'integer' || gettype($row['reporting_date']) == 'double'){
                $row['reporting_date'] = Date::excelToDateTimeObject($row['reporting_date']);
            }
             
        }
        catch (ErrorException $e){
            
            //dd($e);
        }
        //dd($row);
        return $row;
        
    }
    

    
    public function getRowCount(): int
    {
        return $this->rows;
    }
}
