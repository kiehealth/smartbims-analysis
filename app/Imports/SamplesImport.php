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

class SamplesImport implements ToCollection, WithHeadingRow, SkipsOnFailure, WithMapping
{
    
    use SkipsFailures;
    
    
    private $rows = 0; // no. of rows count inserted;
    
    
    
    
    public function collection(Collection $rows)
    {
        $data = $rows->toArray();
        
        $rules = [
            '*.kit_id' => ['required', 'exists:kits,id', 'distinct'],
            '*.sample_id' => ['required', 'exists:kits,sample_id', 'distinct'],
            '*.lab_id' => 'array'
        ];
        
        foreach ($data as $key => $val){
            $rules = array_merge($rules, [$key.'.lab_id' => ['sometimes', 'nullable', 'distinct', 'unique:samples,lab_id,'.$val['kit_id'].',kit_id']]);
        }

        $messages = [];
        
        /*foreach ($data as $key => $val){
            
            $messages["$key.kit_id.required"] = "Error on row: <strong>".($key+2)."</strong>. kit_id missing."
                ." The kit_id is required.";
            $messages["$key.kit_id.unique"] = "Error on row: <strong>".($key+2)."</strong>. The kit_id <strong>".(Arr::exists($val, "kit_id")?$val['kit_id']:"").
                "</strong> seems to have been processed already. ".
                " Only one sample per kit_id.";
                $messages["$key.order_id.exists"] = "Error on row: <strong>".($key+2)."</strong>. No order with order_id <strong>"
                    .(Arr::exists($val, "order_id")?$val['order_id']:"")."</strong> found. The order should be placed "
                        ."before registering a kit.";
                        
                        $messages["$key.order_id.distinct"] = "Error on row: <strong>".($key+2)."</strong>. The order_id <strong>".(Arr::exists($val, "order_id")?$val['order_id']:"").
                        "</strong> has a duplicate value. ".
                        " The order_id must be unique.";
                        
                        
                        
                        $messages["$key.sample_id.required"] = "Error on row: <strong>".($key+2)."</strong>. sample_id missing."
                            ." The sample_id is required.";;
                            $messages["$key.sample_id.unique"] = "Error on row: <strong>".($key+2).
                            "</strong>. The sample_id <strong>".(Arr::exists($val, "sample_id")?$val['sample_id']:"").
                            "</strong> has already been registered. The sample_id must be unique.";
                            
                            $messages["$key.sample_id.distinct"] = "Error on row: <strong>".($key+2)."</strong>. The sample_id <strong>".(Arr::exists($val, "sample_id")?$val['sample_id']:"").
                            "</strong> has a duplicate value. ".
                            " The sample_id must be unique.";
                            
                            
                            
                            
                            $messages["$key.barcode.unique"] = "Error on row: <strong>".($key+2).
                            "</strong>. The barcode <strong>".(Arr::exists($val, "barcode")?$val['barcode']:"").
                            "</strong> has already been registered. The barcode must be unique.";
                            
                            $messages["$key.barcode.distinct"] = "Error on row: <strong>".($key+2)."</strong>. The barcode <strong>".(Arr::exists($val, "barcode")?$val['barcode']:"").
                            "</strong> has a duplicate value. ".
                            " The barcode must be unique.";
                            
                            
                            
                            $messages["$key.kit_dispatched_date.required"] = "Error on row: <strong>".($key+2)."</strong>. kit_dispatched_date missing.".
                                " Please put the date when the kit is going to be dispatched.";
                            
                            
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
                            
        //}
        
        $validator = Validator::make($data, $rules)->validate();
        
        //dd($validator);
        
        /*
        
        foreach ($data as $row) {
            ++$this->rows;
            Kit::create([
                'order_id' => $row['order_id'],
                'user_id' => Order::find($row['order_id'])->user->id,
                'sample_id' => $row['sample_id'],
                'barcode' => $row['barcode'],
                'kit_dispatched_date' => $row['kit_dispatched_date'],
            ]);
            
            Order::find($row['order_id'])->update(['status' => config('constants.kits.KIT_DISPATCHED')]);
        }
        
        */
        
        
    }
    
    
    
    public function map($row): array
    {
        return $row;
    }

    
    public function getRowCount(): int
    {
        return $this->rows;
    }
}
