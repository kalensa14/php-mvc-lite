<?php

use App\Application;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__, 2));

Application::getInstance(Request::createFromGlobals())->run();