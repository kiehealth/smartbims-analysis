<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Personnummer\Personnummer;
use Personnummer\PersonnummerException;

class PersonnummerController extends Controller
{
    public function valid(Request $request) {
        $request->validate([
            'pnr'=>'required'
        ]);
        
        try {
            if(Personnummer::valid($request->pnr)){
                
            }
             Personnummer::valid('20121212-1212'). PHP_EOL;
            echo (new Personnummer('821015-1232'))->format(true). PHP_EOL;
            echo (new Personnummer('8210151232'))->format(true). PHP_EOL;
            echo Personnummer::valid('860716728'). PHP_EOL;
            echo (new Personnummer( $request->pnr))->format(true). PHP_EOL;
        } catch (PersonnummerException $e) {
            //return back()->withError('PNR Invalid ' . $request->input('pnr'))->withInput();
        }
       
    }
    
    
}