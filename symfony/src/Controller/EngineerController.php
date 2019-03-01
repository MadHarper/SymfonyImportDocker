<?php

namespace App\Controller;

use App\Repository\BugRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Services\FreshmanService;

class EngineerController extends AbstractController
{
    /**
     * @Route("/bug")
     */
    public function show(BugRepository $bugRepository)
    {
       $res = $bugRepository->countOpenBugsForProductDQL(2);
       dd($res); die;
    }
}