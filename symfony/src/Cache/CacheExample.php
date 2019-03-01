<?php

namespace App\Cache;

use Symfony\Component\Cache\Adapter\TraceableAdapter;

class CacheExample
{
    /**
     * @var TraceableAdapter
     */
    public $cache;

    function __construct(TraceableAdapter $cache)
    {
        $this->cache = $cache;
    }


}
