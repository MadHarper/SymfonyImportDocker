<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ArticleType;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/manager/article/new", name="admin_article_new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $entityManager->persist($article);
           $entityManager->flush();
        }
        return $this->render('articleAdmin/new.html.twig', ['articleForm' => $form->createView()]);
    }

    /**
     * @Route("/manager/article/edit/{id}", name="admin_article_edit")
     */
    public function edit(Article $article = null,Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();
        }
        return $this->render('articleAdmin/new.html.twig', ['articleForm' => $form->createView()]);
    }

    /**
     * @Route("/manager/article/raw", name="admin_article_raw")
     */
    public function raw(Request $request, ArticleRepository $articleRepository)
    {
        $a = $articleRepository->findByRawSql();
        dd($a);die;
        return $this->render('articleAdmin/new.html.twig', ['form' => $form->createView()]);
    }

}