<?php

namespace Domain;

interface DemoRepository
{
    public function find($id);

    /**
     * Cached function
     */
    public function findAll();
}