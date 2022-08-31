<?php

use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use Symfony\Component\Routing\Route;

/** @var \Symfony\Component\Routing\RouteCollection $routes */
$routes->add(
    'login.show',
    new Route('/', [
        'controller' => LoginController::class,
        'method' => 'show'
    ])
);
$routes->add(
    'login.store',
    new Route('/', [
        'controller' => LoginController::class,
        'method' => 'store'
    ], [], [], null, [], ['POST'])
);
$routes->add(
    'register.show',
    new Route('/register', [
        'controller' => RegisterController::class,
        'method' => 'show'
    ])
);
$routes->add(
    'logout.store',
    new Route('/logout', [
        'controller' => LogoutController::class,
        'method' => 'store'
    ], [], [], null, [], ['POST'])
);