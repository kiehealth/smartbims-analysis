<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    
    /**
     * Get the user with specified PNR.
     * 
     * @param  string $pnr
     * @return  \App\Models\User
     */
    
    public function getUserbyPNR(String $pnr){
        
        return User::where('pnr', $pnr)->firstOrFail();
        
    }
    
    
    /**
     * Get the user with specified SSN.
     *
     * @param  string $ssn
     * @return  \App\Models\User
     */
    
    public function getUserbySSN(String $ssn){
        
        return User::where('ssn', $ssn)->firstOrFail();
        
    }
}

