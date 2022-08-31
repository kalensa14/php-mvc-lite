<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;

class LoginController
{
    public function show(Request $request): string
    {
        return view('login.php', ['test' => 'passed', 'routes' => resolve('routes')]);
    }
}