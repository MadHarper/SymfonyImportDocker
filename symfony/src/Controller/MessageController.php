<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\Notification;

class MessageController extends AbstractController
{
    /**
     * @Route("/message")
     */
    public function index(Request $request, MessageBusInterface $bus)
    {
        $bus->dispatch(new Notification('A string to be sent...'));

        dd('ok');
    }
}