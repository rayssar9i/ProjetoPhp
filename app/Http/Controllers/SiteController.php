<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
    $search = request('search');
        if($search){
            $receitas = receitas::where([
                ['title', 'like', '%'.$search.'%']
            ])
        }else{
            $receitas = receitas::all();
        }
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
