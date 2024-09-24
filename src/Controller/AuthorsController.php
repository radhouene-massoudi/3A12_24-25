<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Length;

#[Route('/authors')]
class AuthorsController extends AbstractController
{
    #[Route('/a', name: 'app_authors')]
    public function index(): Response
    {
        return $this->render('authors/index.html.twig', [
            'controller_name' => 'AuthorsController',
        ]);
    }
    #[Route('/b', name: 'author')]
    public function listAuthors(){
       
        $authors = array(
            array('id' => 1, 'picture' => 'hugo.png','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => 'hugo.png','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => 'taha.png','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),);

            return $this->render('authors/list.html.twig',[
                'authors'=>$authors
            ]);
    }



    public function ssayHello(){
return new Response('hello');
    }

    #[Route('/d/{id}', name: 'detailsauthors')]
    public function detailauthor($id){
        $authors = array(
            array('id' => 1, 'picture' => 'hugo.png','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => 'hugo.png','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => 'taha.png','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),);

            
            for( $i=0 ;$i<count($authors) ;$i++)
            {
                if($authors[$i]['id']==$id){
                    return $this->render('authors/detail.html.twig',[
                        'author'=>$authors[$i]
                    ]);
                }
            }

        
    }
}
