<?php

namespace App\Imports;

use App\Models\Order;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Personnummer\Personnummer;
use Personnummer\PersonnummerException;

class OrdersImport implements ToCollection, WithHeadingRow, SkipsOnFailure
{
    use SkipsFailures;
    
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    private $userRepo;
    
    private $rows = 0, $errors_msg = []; // array to accumulate errors;
    
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository $userRepo
     * @return  void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    
    
    public function collection(Collection $rows)
    {
        $validator = Validator::make($rows->toArray(), [
            '*.pnr' => [function ($attribute, $value, $fail){
                            $attribute = preg_replace('/[^0-9]/', '', $attribute);
                            if(strlen(trim($value)) === 0){
                                /*$fail("Error on row: <strong>".($attribute+2).
                                                  "</strong>. The pnr is required.");*/
                                $this->errors_msg[] = "Error on row: <strong>".($attribute+2).
                                                        "</strong>. The pnr is required.";
                                
                            }
                            elseif(strlen(trim($value)) !== 12){
                                /*$fail("Error on row: <strong>".($attribute+2).
                                    "</strong>. Please provide the pnr with the 12 digits in the format ÅÅÅÅMMDDNNNN without hyphen.");
                                $this->errors_msg[] = "Error on row: <strong>".($attribute+2).*/
                                    "</strong>. Please provide the pnr with the 12 digits in the format ÅÅÅÅMMDDNNNN without hyphen.";
                            }
                            else{
                                try{
                                    $pnr = (new Personnummer($value))->format(true);
                                    if(!$this->userRepo->getUserbyPNR($pnr)->exists){
                                        /*$fail("Error on row: <strong>".($attribute+2).
                                            "</strong>. User with PNR <strong>".$pnr.
                                            "</strong> does not exist.");*/
                                        $this->errors_msg[] = "Error on row: <strong>".($attribute+2).
                                            "</strong>. User with PNR <strong>".$pnr.
                                            "</strong> does not exist.";
                                   }
                                }
                                catch (PersonnummerException $e){
                                    /*$fail("Error on row: <strong>".($attribute+2).
                                    "</strong>. PNR Invalid <strong>".$value."</strong>.");*/
                                    $this->errors_msg[] = "Error on row: <strong>".($attribute+2).
                                    "</strong>. PNR Invalid <strong>".$value."</strong>.";
                                }
                                catch (ModelNotFoundException $e){
                                    /*$fail("Error on row: <strong>".($attribute+2).
                                        "</strong>. User with PNR <strong>".$pnr.
                                        "</strong> does not exist. Before creating order, the user should already exist.");*/
                                    $this->errors_msg[] = "Error on row: <strong>".($attribute+2).
                                        "</strong>. User with PNR <strong>".$pnr.
                                        "</strong> does not exist. Before creating order, the user should already exist.";
                                }
                            }
                            
                            
                        },
            
            ]
        ])/*->validate()*/; 

        //Distinct pnrs check
        
        $non_empty_pnrs = $rows->reject(function($item){
            return empty($item['pnr']);
        });
        //dump($non_empty_pnrs);
        $non_empty_formatted_pnrs = $non_empty_pnrs->map(function($item){
            if(Personnummer::valid($item['pnr']))
                return (new Personnummer($item['pnr']))->format(true);
        });
        
        //dump($non_empty_formatted_pnrs);
        $duplicate_pnrs = $non_empty_formatted_pnrs->duplicates();
        
        //dd($duplicate_pnrs);
        $duplicate_pnrs->each(function ($item, $key) {
            //echo $item." ".$key."\n";
            if(!is_null($item))
                $this->errors_msg[] =  "Error on row: <strong>".($key+2).
                "</strong>. The pnr <strong>".$item."</strong> has a duplicate value.";
            
        });
        
        
        
        if (!$validator->fails() && empty($this->errors_msg)) {
            foreach ($rows as $row) {
                ++$this->rows;
                 Order::create([
                    'user_id' => $this->userRepo->getUserbyPNR((new Personnummer($row['pnr']))->format(true))->id,
                    'order_created_by' => is_null(Session::get('userattributes'))?null:Str::title(Session::get('userattributes')['givenName'])." ".Str::title(Session::get('userattributes')['surname'])
                 ]);
             }
        }
        
       
        
    }
    
    
    
    public function getRowCount(): int
    {
        return $this->rows;
    }
    

    public function getErrors()
    {
        return $this->errors_msg;
    }

}
