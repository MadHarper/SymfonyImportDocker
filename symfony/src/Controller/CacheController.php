<?php

namespace App\Controller;

use App\Entity\Article;
use Psr\Container\ContainerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use App\Cache\CacheExample;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\ArticleRepository;

class CacheController extends AbstractController
{
    /**
     * @Route("/redis")
     */
    public function index(AdapterInterface $cache, CacheExample $cacheExample)
    {
        $demoOne = $cache->getItem('demo_array');

        if (!$demoOne->isHit())
        {
            $demoOne->set(["one", "two", "three"]);
            $cache->save($demoOne);
        }

        $demoTwo = $cache->getItem('demo_two');

        if (!$demoTwo->isHit())
        {
            $demoTwo->set(["mercia" => "kingdom", "saxonia" => "duke", "prussia" => "kurf"]);
            $cache->save($demoOne);
        }

        $exampleItem = $cacheExample->cache->getItem('example_item');
        if (!$exampleItem->isHit())
        {
            $exampleItem->set(["Ragnar", "Floki", "Ivar"]);
            $cacheExample->cache->save($exampleItem);
        }

        dd('ok');
    }

    /**
     * @Route("/redis-check")
     */
    public function second(AdapterInterface $cache)
    {
        $demoOne = $cache->getItem('demo_array');

        dd($demoOne->get());

//        $demoTwo = $cache->getItem('demo_two');
//
//        dd($demoTwo);

    }

    /**
     * @Route("/redis-notfrash")
     */
    public function third(CacheExample $cacheExample)
    {
        $exampleItem = $cacheExample->cache->getItem('example_item');

        if (!$exampleItem->isHit())
        {
            dd('Not fresh!');
        }

        dd($exampleItem->get());
    }

    /**
     * @Route("/serialize")
     */
    public function four(SerializerInterface $serializer,
                         ArticleRepository $articleRepository,
                         CacheExample $cacheExample)
    {
        $article = $articleRepository->find(6);
        $ser = $serializer->serialize($article, 'json', ['groups' => 'group2'] );

        $exampleItem = $cacheExample->cache->getItem('article_item');

        if (!$exampleItem->isHit())
        {
            $exampleItem->set($ser);
            $cacheExample->cache->save($exampleItem);
        }

        dd('ok');
    }

    /**
     * @Route("/deserialize")
     */
    public function five(SerializerInterface $serializer,
                         CacheExample $cacheExample)
    {
        $exampleItem = $cacheExample->cache->getItem('article_item');

        if (!$exampleItem->isHit())
        {
            dd('not found...');
        }

        dd($exampleItem->get());

        $article = $serializer->deserialize($exampleItem->get(), 'App\Entity\Article', 'json', [
            'allow_extra_attributes' => false,
        ]);

        dd($article);
    }

    /**
     * @Route("/ser_collection")
     */
    public function six(SerializerInterface $serializer,
                        ArticleRepository $articleRepository,
                        CacheExample $cacheExample)
    {
        $articles = $articleRepository->findAll();

        $serial = $serializer->serialize($articles, 'json', ['groups' => 'group2'] );
        dd($serial);
    }
}