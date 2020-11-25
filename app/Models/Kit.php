<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    //
    public $timestamps = true;
    
    protected $fillable = [
        'order_id',
        'user_id',
        'sample_id',
        'barcode',
        'kit_dispatched_date',
        'sample_received_date',
        'created_at',
        'updated_at'
    ];
    
    
    /**
     * Get the user for the kit.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    
    /**
     * Get the order for the kit.
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
