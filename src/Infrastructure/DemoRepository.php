<?php

namespace Infrastructure;

use Domain\DemoRepository as DemoRepositoryInterface;

class DemoRepository implements DemoRepositoryInterface
{
    private $connection;
    /** @var CacheService */
    private $cacheService;

    public function __construct($connection, $cacheService)
    {
        $this->connection = $connection;
        $this->cacheService = $cacheService;
    }
    public function find($id)
    {
        $query = "SELECT * FROM table WHERE id = {$id}";

        return $this->connection->excute($query);
    }

    /**
     * Cached function
     */
    public function findAll()
    {
        $query = "SELECT * FROM table";

        $result = $this->cacheService->get($query);
        if (!is_null($result)) {
            return $result;
        }

        $result = $this->connection->excute($query);
        $this->cacheService->set($query, $result);

        return $result;
    }
}
