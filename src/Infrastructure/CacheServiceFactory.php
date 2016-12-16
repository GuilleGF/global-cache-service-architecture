<?php

namespace Infrastructure;

use Infrastructure\Redis\RedisCacheService;

class CacheServiceFactory
{
    public function create()
    {
        if (ENV == 'DEV') {
            return new DummyCahceService();
        }

        return new RedisCacheService();
    }
}
