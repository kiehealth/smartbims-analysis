<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;


class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable;
    
    //
    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name',
        'email',
        'ssn',
        'password',
        'phonenumber',
        'roles',
        'street',
        'zipcode',
        'city',
        'country',
        'consent',
        'created_at',
        'updated_at'
    ];
    
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
