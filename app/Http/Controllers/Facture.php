<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Facture extends Controller
{
    public function index()
    {
    	return view('facture\facture_index');
    }
}
