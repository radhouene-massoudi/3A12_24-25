<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/add', name: 'add_student')]
    public function addStudnet(ManagerRegistry $mr){
$st=new Student();
$st->setName('3A12');
$st->setAge(44);
$st->setCreatedAt(new DateTimeImmutable('now'));
$em=$mr->getManager();
$em->persist($st);
$em->flush();
return $this->redirectToRoute("list_student");
    }
    #[Route('/list', name: 'list_student')]
    public function fetchStudents(ManagerRegistry $mr){
$repo=$mr->getRepository(Student::class);
$students=$repo->findAll();
return $this->render('student/list.html.twig',[
's'=>$students
]);
    }
    #[Route('/remove/{id}', name: 'remove_student')]
    public function removeStudnet($id,ManagerRegistry $mr,StudentRepository $repo){
$em=$mr->getManager();
$student=$repo->find($id);
$em->remove($student);
$em->flush();
return $this->redirectToRoute('list_student');
    }
}
