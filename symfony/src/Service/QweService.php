<?php

namespace App\Service;

use App\Helper\LoggerTrait;

class QweService
{
    use LoggerTrait;

    public function bar()
    {
        $this->logInfo("Trait an @require annotation work!");
    }
}
