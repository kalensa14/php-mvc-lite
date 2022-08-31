<?php

namespace App\Contracts;

interface RepositoryInterface
{
    public function find(int $id): ?ModelInterface;

    public function all(): array;
}