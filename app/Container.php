<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\Container\NotFoundException;

class Container
{
    private static array $container = [];

    public function has(string $id): bool
    {
        return array_key_exists($id, static::$container);
    }

    /**
     * @throws NotFoundException
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new NotFoundException(sprintf('There is no instance for %.', $id));
        }

        return static::$container[$id];
    }

    public function set(string $id, mixed $instance): mixed
    {
        return static::$container[$id] = $instance;
    }
}