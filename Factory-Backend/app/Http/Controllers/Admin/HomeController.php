<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        // It is testing for remote git
        return view('home');
    }
}
