<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UserType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function signup(Request $request,
                           UserPasswordEncoderInterface $encoder,
                           EntityManagerInterface $em)
    {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $plainPassword = $form['plainPassword']->getData();

            $user->setPassword($encoder->encodePassword($user, $plainPassword));

            $em->persist($user);
            $em->flush();
        }

        return $this->render('security/signup.html.twig', ['signUpForm' => $form->createView()]);
    }

    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig',  [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('Will be intercepted before getting here');
    }

    /**
     * @Route("/calculate/{id}", name="calculate_pass")
     */
    public function calculatePass(Users $user = null,
                                  UserPasswordEncoderInterface $encoder,
                                  EntityManagerInterface $em)
    {
        $user->setPassword($encoder->encodePassword($user, "123"));
        $em->flush();

        echo "ok"; die;
    }
}