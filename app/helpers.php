<?php

use App\Application;

if (!function_exists('view')) {
    function view(string $path, array $data = []): string
    {
        if ($data) {
            extract($data);
        }

        ob_start();

        include APP_ROOT . '/views/' . $path;

        $contents = ob_get_contents();
        @ob_end_clean();
        return $contents;
    }
}

if (!function_exists('resolve')) {
    /**
     * @param string $abstract
     * @return mixed
     * @throws \App\Exceptions\Container\NotFoundException
     */
    function resolve(string $abstract): mixed
    {
        return Application::getInstance()->resolve($abstract);
    }
}

if (!function_exists('view_path')) {
    function view_path(string $target = null): string
    {
        return APP_ROOT . '/views' . ($target ? '/' . $target : '');
    }
}

if (!function_exists('route')) {
    /**
     * @param string $name
     * @return string
     * @throws \App\Exceptions\Container\NotFoundException
     */
    function route(string $name): ?string
    {
        /** @var \Symfony\Component\Routing\RouteCollection $routes */
        $routes = resolve('routes');
        return $routes->get($name)?->getPath();
    }
}