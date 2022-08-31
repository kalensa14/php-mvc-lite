<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;

class RegisterController
{
    public function show(Request $request): string
    {
        return view('register.php');
    }

    public function store(Request $request)
    {

    }
}