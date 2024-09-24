<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    #[Route('/test', name: 'test')]
    public function fistmethode(){
        return new Response('<b>3A12 is the best</b>');
    }

    #[Route('/html', name: 'html')]
    public function fistmethodehtml(){
        return $this->render("firsthtml/3a12.html");
    }
    #[Route('/detail/{p}', name: 'detail')]
    public function detail($p){
        return new Response($p);
    }
    #[Route('/d/{idt}', name: 'd')]
    public function detailhtml($idt){
        return $this->render("first/home.html.twig",[
          'i'=>$idt  
        ]);
    }

    #[Route('/twig', name: 'twig')]
    public function twig(){
        $klass="3A12 is the best";
        return $this->render("twig/firstfiletwig.html.twig",
        [
          'i'=>$klass
        ]);
    }
    #[Route('/auth', name: 'auth')]
    public function authors(){
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        return $this->render('twig/authors.html.twig',
        [
            'a' => $authors
        ]);
    }
}
