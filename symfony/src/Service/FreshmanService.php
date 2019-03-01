<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class FreshmanService
{
    private $logger;
    private $isDebug;

    function __construct($isDebug, LoggerInterface $myOwnLogger)
    {
        $this->logger = $myOwnLogger;
        $this->isDebug = $isDebug;
    }

    public function run($name)
    {
        if($this->isDebug){
            $this->logger->warning("Hmmm... in target file with debug");
        }
        return "Hello $name";
    }
}