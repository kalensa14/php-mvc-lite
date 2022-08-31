<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class LogoutController
{
    public function store(Request $request): RedirectResponse
    {
        return new RedirectResponse(route('login'));
    }
}