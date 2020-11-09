<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    //
    public $timestamps = true;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'pnr',
        'phonenumber',
        'street',
        'zipcode',
        'city',
        'country',
        'created_at',
        'updated_at'
    ];
    
    
    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    
   
}
