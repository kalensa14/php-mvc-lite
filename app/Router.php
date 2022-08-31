<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Router
{
    public function __construct(private readonly RouteCollection $routes)
    {
    }

    public function runRoute(Request $request): mixed
    {
        $context = (new RequestContext())->fromRequest($request);
        $matcher = new UrlMatcher($this->routes, $context);

        $match = $matcher->match($request->getRequestUri());

        array_walk($match, static function (&$param) {
            if (is_numeric($param)) {
                $param = (int)$param;
            }
        });

        $className = $match['controller'];
        $controller = new $className();

        $params = array_merge(array_slice($match, 2, -1), ['request' => $request]);

        return call_user_func_array([$controller, $match['method']], $params);
    }
}