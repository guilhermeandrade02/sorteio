<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SorteioController extends Controller
{
  
    public function indexLaravel()
    {
        return view('index-laravel');
    }

    
    public function geradorLaravel(Request $request)
    {
        
        $namesArray = explode("\n", $request->names);
        $namesArray = array_map('trim', $namesArray);
        $namesArray = array_map(function ($name) {
            return str_replace(["\r", "\n"], '', $name);
        }, $namesArray);              
              
        $ganhadoresCount = '1';      
       
        $ganhadores = [];
     
        if ($ganhadoresCount > 0) {
            $randomKeys = array_rand($namesArray, $ganhadoresCount);     
            if (!is_array($randomKeys)) {               
                $randomKeys = [$randomKeys];
            }    
            foreach ($randomKeys as $key) {
                $ganhadores = $namesArray[$key]; 
            }
        }
        // dd($ganhadores);
        return view('index-laravel',[
            'names' => $namesArray,
            'ganhadores' => $ganhadores, 
        ]);
    }
}
