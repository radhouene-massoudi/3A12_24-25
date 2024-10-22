<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentFormType;
use App\Repository\StudentRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
if($student!=null){
    $em->remove($student);
    $em->flush();
}else {
    return  new Response("id n'esxiste pas ");
}

return $this->redirectToRoute('list_student');
    }

    #[Route('/addform', name: 'addform')]
    public function addStudnetForm(ManagerRegistry $mr,Request $req){
        $st=new Student();
        //$st->setName('esprit 3A12');
        $form=$this->createForm(StudentFormType::class,$st);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            //dd($st);
          // dd($req->request->getData());//
            $em=$mr->getManager();
            $em->persist($st);
            $em->flush();
            return $this->redirectToRoute('list_student');
        }
        return $this->render("student/addform.html.twig",[
            'f'=>$form->createView()
        ]);

    }

    #[Route('/update/{id}', name: 'update')]
    public function updateStudnetForm(ManagerRegistry $mr,Request $req){
    }

    #[Route('/findall', name: 'findall')]
    public function findall(EntityManagerInterface $em){
$dql=$em->createQuery("select s from App\Entity\Student s where s.name=:name ");
$dql->setParameter('name','ali');
$result=$dql->getResult();
dd($result);
    }
    
    #[Route('/findallinrepo', name: 'findallinrepo')]
    public function findallinrepo(StudentRepository $repo){
        $result=$repo->findallQB();
        dd($result);
    }

    #[Route('/search', name: 'search')]
    public function search(StudentRepository $repo,Request $req){
if($req->isMethod('POST')){
        $name=$req->get('3A');

$result=$repo->searchByName($name);
return $this->render('student/list.html.twig',[
    's'=>$result
    ]);
}else {
    return new Response('error get method');
}
    }
}
