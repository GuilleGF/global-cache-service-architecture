<?php

namespace Infrastructure;

interface CacheService
{
    public function get($query);

    public function set($query, $result, $ttl);
}