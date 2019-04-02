<?php

namespace App\MessageHandler;

use App\Message\Notification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Psr\Log\LoggerInterface;

class NotificationHandler implements MessageHandlerInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Notification $notification)
    {
        $line = "From Handler. " . $notification->getContent();
        $this->logger->warning($line);
    }
}
