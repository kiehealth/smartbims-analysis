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
        //'roles',
        'street',
        'zipcode',
        'city',
        'country',
        'consent',
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
    
    
    /**
     * Get the kits for the user.
     */
    public function kits()
    {
        return $this->hasMany('App\Models\Kit');
    }
    
    
    /**
     * Get all of the samples for the user.
     */
    public function samples()
    {
        return $this->hasManyThrough(Sample::class, Kit::class);
    }
   
}
