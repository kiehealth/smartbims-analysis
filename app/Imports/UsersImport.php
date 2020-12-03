<?php

namespace App\Imports;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Personnummer\Personnummer;
use Personnummer\PersonnummerException;

class UsersImport implements ToCollection, WithHeadingRow, SkipsOnFailure
{
    use SkipsFailures;
    
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    private $userRepo;
    
    private $rows = 0, $errors = []; // array to accumulate errors;
    
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
        //dd($rows->duplicates());
        //dd($rows->toArray());
        $messages = [];
        $data = $rows->toArray();
        
        $validator = Validator::make($rows->toArray(), [
            '*.pnr' => ['required',
                        //'distinct',
                        'unique:users,pnr',
                        function ($attribute, $value, $fail) use ($rows){
                            $attribute = preg_replace('/[^0-9]/', '', $attribute);
                            
                            (function () use ($rows, $attribute, $value){
                                $after_reject = $rows->reject(function($item){
                                    return empty($item['pnr']);
                                });
                                    dd(collect($after_reject)->duplicates('pnr'));
                                $filter = $after_reject->filter(function($item) use ($attribute, $value){
                                    $this->errors[] =  ($item['pnr'] === $value)? "Error on row: <strong>".($attribute+2).
                                    "</strong>. The pnr ".$value." has a duplicate value.":"";
                                    
                                    return $item['pnr'] === $value;
                                });
                                
                            })();
                            
                            /*
                            $count = function() use($rows){
                            $rows->reject(function ($item) {
                                return empty($item['pnr']);
                            })
                            ->filter(function ($item) use ($value) {
                                return $item['pnr'] === $value;
                            })                            };
                            
                            if ($count > 1) {
                                $fail(__('validation.distinct'));
                            }
                            */
                            
                            
                           // dd($errors);
                                
                            
                            try{
                                $pnr = (new Personnummer($value))->format(true);
                                if($this->userRepo->getUserbyPNR($pnr)->exists){
                                    $fail('User with PNR '.$pnr. ' already exists!');
                                    $this->errors[] = "Error on row: <strong>".($attribute+2).
                                                      "</strong>. User with PNR <strong>".$pnr.
                                                      "</strong> already exists!";
                                    
                                }
                            }
                            catch (PersonnummerException $e){
                                $fail('PNR Invalid '.$value);
                                $this->errors[] = "Error on row: <strong>".($attribute+2).
                                                  "</strong>. PNR Invalid <strong>".$value."</strong>.";
                            }
                            catch (ModelNotFoundException $e){
                                
                            }
                        },
            
            ]
        ]); 
        
        /* if ($validator->fails()){
            foreach ($validator->errors()->get('*.pnr') as $message) {
                dump($message);
            }
        } */
        
        
        
        if (!$validator->fails()) {
            foreach ($rows as $row) {
                ++$this->rows;
                 User::create([
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'pnr' => (new Personnummer($row['pnr']))->format(true),
                    'phonenumber' => $row['phonenumber'],
                    'roles' => $row['roles'],
                    'street' => $row['street'],
                    'zipcode' => $row['zipcode'],
                    'city' => $row['city'],
                    'country' => $row['country'],
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
        return $this->errors;
    }

}
