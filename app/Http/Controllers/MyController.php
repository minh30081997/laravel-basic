<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function blade()
    {
        return view('pages.dashboard');
    }
}
