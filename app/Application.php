<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\RouteCollection;

class Application
{
    private static self $app;

    private Container $container;

    private function __construct(protected Request $request)
    {
        $this->container = new Container();
    }

    public static function getInstance(Request $request = null): self
    {
        return self::$app ?? self::$app = new static($request);
    }

    /**
     * @return void
     */
    public function run(): void
    {
        try {
            $this->registerDatabase();

            /** @var null|string|Response $response */
            $response = $this->resolve('router', $this->makeRouter())
                ->runRoute($this->request);
        } catch (RouteNotFoundException|NotFoundHttpException) {
            $response = new Response('Page not found.', 404);
        } catch (\Throwable) {
            $response = new Response('Internal server error.', 500);
        }

        if (!$response instanceof Response) {
            $response = new Response($response);
        }

        $response->send();
    }

    /**
     * @return Router
     * @throws Exceptions\Container\NotFoundException
     */
    private function makeRouter(): Router
    {
        /** @var RouteCollection $routes */
        $routes = $this->resolve('routes', new RouteCollection());
        require_once APP_ROOT . '/routes/web.php';

        return new Router($routes);
    }

    /**
     * @return void
     * @throws Exceptions\Container\NotFoundException
     */
    private function registerDatabase(): void
    {
        $this->resolve('db', new Database());
    }

    /**
     * @param string $abstract
     * @param mixed|null $instance
     * @return mixed
     * @throws Exceptions\Container\NotFoundException
     */
    public function resolve(string $abstract, mixed $instance = null): mixed
    {
        if (!is_null($instance)) {
            if (is_callable($instance)) {
                $instance = $instance($this);
            } elseif (is_string($instance)) {
                $instance = new $instance();
            }

            $this->container->set($abstract, $instance);
        }

        return $this->container->get($abstract);
    }
}