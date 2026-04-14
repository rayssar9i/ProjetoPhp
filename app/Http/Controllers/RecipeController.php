<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(){
       return view('recipes.home');
    }

    public function show(){
        return view('recipes.show_recipe');
    }
    public function profile(){
        return view('recipes.profile');
    }
    



     //public function create(){
        //return view('events.create')
}
