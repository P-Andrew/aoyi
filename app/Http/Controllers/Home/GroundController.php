<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroundController extends Controller
{
    public function index()
    {
        return view('home.greenhouse');
    }
}
