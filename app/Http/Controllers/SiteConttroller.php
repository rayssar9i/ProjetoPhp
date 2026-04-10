<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteConttroller extends Controller
{
    public function index(){
    $nome = "Rayssa";
    $idade = "20";
    $array = ["joana", "jose", "joao"]; 
    return view('contact', 
    [
        'nome' => $nome,
        'idade' => $idade,
        'array' => $array  
        
    ]);
    }

    public function create(){
        return view('events.create');
    }
}
