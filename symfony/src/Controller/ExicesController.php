<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\PersistentCollection;

class ExicesController extends AbstractController
{
    /**
     * @Route("/ex1")
     */
    public function ex1(ProductRepository $productRepository)
    {
       $res = $productRepository->findAllWithPC();

        foreach ($res as $product) {
           foreach ($product->getPc() as $pc) {
               var_dump($pc->getId());
           }
       }

       die;
    }

    /**
     * @Route("/ex7")
     */
    public function ex7(ProductRepository $productRepository)
    {
        $res = $productRepository->getEx7('B');
        dd($res);
    }

}