<?php

declare(strict_types=1);

namespace App\Exceptions\Container;

use App\Contracts\Container\NotFoundExceptionInterface;
use Exception;

class NotFoundException extends Exception implements NotFoundExceptionInterface
{
}