<?php

declare(strict_types=1);

namespace App\Exceptions\Container;

use App\Contracts\Container\ContainerExceptionInterface;
use Exception;

class ContainerException extends Exception implements ContainerExceptionInterface
{
}