<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Personnummer\Personnummer;
use Personnummer\PersonnummerException;
use App\Models\User;
use App\Repositories\UserRepository;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

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
        $validator = Validator::make($rows->toArray(), [
            '*.pnr' => ['required', 
                        'unique:users,pnr',
                        function ($attribute, $value, $fail) {
                            
                            $attribute = preg_replace('/[^0-9]/', '', $attribute);
                            try{
                                $pnr = (new Personnummer($value))->format(true);
                                if($this->userRepo->getUserbyPNR($pnr)->exists){
                                    $fail('User with PNR '.$pnr. ' already exists!');
                                    $this->errors[] = "Error on row: ".($attribute+2)." User with PNR ".$pnr. " already exists!";
                                    
                                }
                            }
                            catch (PersonnummerException $e){
                                $fail('PNR Invalid '.$value);
                                $this->errors[] = "Error on row: ".($attribute+2)." PNR Invalid ".$value;
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
