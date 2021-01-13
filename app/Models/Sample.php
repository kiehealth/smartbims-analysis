<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    //
    public $timestamps = true;
    
    protected $fillable = [
        'kit_id',
        'sample_id',
        'lab_id',
        'sample_registered_date',
        'cobas_result',
        'genotyping_result',
        'luminex_result',
        'analysis_date',
        'rtpcr_result',
        'rtpcr_analysis_date',
        'reported_via',
        'reporting_date',
        'created_at',
        'updated_at'
    ];
    
    
    /**
     * Get the kit for the sample.
     */
    public function kit()
    {
        return $this->belongsTo('App\Models\Kit');
    }
}
