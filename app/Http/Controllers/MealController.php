<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;

class MealController extends Controller
{
     public function index()
    {

        $meals = Meal::all(); 
               
        return view('meals', compact('meals'));
    }
}

