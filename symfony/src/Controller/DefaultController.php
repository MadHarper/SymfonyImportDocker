<?php

namespace App\Controller;

use App\Service\FreshmanService;
use App\Service\QweService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage(Request $request, FreshmanService $freshman)
    {
        $freshman->run("bullshit");
        $user = $request->getUser();

        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

    /**
     * @Route("/news/{slug}")
     */
    public function news($slug)
    {
        return new Response(
            '<html><body>'. $slug .'</body></html>'
        );
    }

    /**
     * @Route("/qwe")
     */
    public function traitTest(QweService $qwe)
    {
        $qwe->bar();
        dd(1);
    }
}