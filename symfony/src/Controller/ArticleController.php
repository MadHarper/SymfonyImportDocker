<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Service\FreshmanService;

class ArticleController extends AbstractController
{
    /**
     * @Route("/show/{slug}")
     */
    public function show($slug, LoggerInterface $logger)
    {
        $logger->warning('logger work', ['show action']);

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
        ]);
    }

    /**
     * @Route("/fresh", name="fresh")
     */
    public function fresh(FreshmanService $service)
    {

        $phrase = $service->run("Alex");

        return $this->render('article/fresh.html.twig', [
            'title' => $phrase,
        ]);
    }

}