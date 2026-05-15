<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
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

    public function produtos(){
        $busca = request('search');

        return view('produtos', ['busca' => $busca]);
    }

    public function produto($id){
        return view('produto', ['id' => $id]);
    }
}
