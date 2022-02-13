<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecrutyController extends AbstractController
{
    /**
     * @Route("/register", name="user_register")
     */
    public function register(Request $request,EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder)
    {
        $user=new User();

        $form=$this->createForm(RegistrationType::class,$user);

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()){

            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute("user_login");
        }
        return $this->renderForm('secruty/registration.html.twig',
            ["form"=>$form]);

    }
    /**
    * @Route ("/login",name="user_login")
     **/
    public function login():Response{
       return $this->render("secruty/login.html.twig");
    }

    /**
     * @Route ("/logout",name="user_logout")
     **/
    public function logout(){

    }

}
