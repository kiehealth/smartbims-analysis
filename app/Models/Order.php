<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $timestamps = true;
    
    protected $fillable = [
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];
    
    
    /**
     * Get the user for the order.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
