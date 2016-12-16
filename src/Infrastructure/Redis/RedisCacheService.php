<?php

namespace Infrastructure\Redis;

use Infrastructure\CacheService;

class RedisCacheService implements CacheService
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function get($query)
    {
        $key = $this->generateKey($query);

        return $this->connection->get($key);
    }

    public function set($query, $result, $ttl)
    {
        $key = $this->generateKey($query);
        $contend = $this->serializeContend($result);

        return $this->connection->set($key, $contend, $ttl);
    }

    private function generateKey($query)
    {
        return md5($query);
    }

    private function serializeContend($result)
    {
        return serialize($result);
    }
}
