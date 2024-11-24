<?php

namespace App\Services;

use App\Contracts\JobStorageInterface;
use Illuminate\Support\Facades\Redis;

class RedisJobStorage implements JobStorageInterface
{
    /**
     * @param string $id
     * @param array $data
     * @return void
     */
    public function store(string $id, array $data): void
    {
        Redis::set($id, json_encode($data));
    }

    /**
     * @param string $id
     * @return array|null
     */
    public function find(string $id): ?array
    {
        $data = Redis::get($id);
        return $data ? json_decode($data, true) : null;
    }

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        Redis::del($id);
    }
}
