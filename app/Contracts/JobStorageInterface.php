<?php

namespace App\Contracts;

interface JobStorageInterface
{
    /**
     * @param string $id
     * @param array $data
     * @return void
     */
    public function store(string $id, array $data): void;

    /**
     * @param string $id
     * @return array|null
     */
    public function find(string $id): ?array;

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void;
}
