<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ChambreController extends AbstractController
{
    /**
    * @Route("/chambre", name="chambre")
    */
    public function index()
    {
        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }

    /**
    * @Route("/chambre/addroom", name="addroom")
    */
    public function addroom( Request $request, EntityManagerInterface $em) :Response{
            $rp= $em->getRepository(Chambre::class);
            $nbrField=count($rp->findAll());
            $chambre = new Chambre();
            $form = $this->createForm(ChambreType::class, $chambre);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($chambre);
                $em->flush();
            }

        return $this->render('chambre/addroom.html.twig',[
            'form'=>$form->createView(),
            'nbrField'=>$nbrField
        ]);
    }

    /**
    * @Route("/chambre/{id<[0-9]+>}/updateroom", name="updateroom", methods={"POST","GET"})
    */
    public function updateroom( Request $request, EntityManagerInterface $em, Chambre $chambre) :Response{
        /* $chambre = new Chambre(); */
        $rp= $em->getRepository(Chambre::class);
        $nbrField=count($rp->findAll());
        $form= $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /* $em->persist($chambre); */
            $em->flush();
            return $this->redirectToRoute('listroom');
        }

        return $this->render('chambre/addroom.html.twig',[
            'form'=>$form->createView(),
            'nbrField'=>$nbrField
        ]);
    }

    /**
     * @Route("/chambre/{id<[0-9]+>}/deleteroom", name="deleteroom")
     */
    public function deleteroom(EntityManagerInterface $em, Chambre $chambre)
    {
        $em->remove($chambre);
        $em->flush();
        return $this->redirectToRoute('listroom');
    }

    /**
    * @Route("/chambre/listroom", name="listroom")
    */
    public function listroom( ChambreRepository $repo, PaginatorInterface $paginator, Request $request ) {
        
        $chambres = $repo->findAll(); // Afficher l'intégralité de l'entité Chambre
        
        $pagination= $paginator->paginate(
            $chambres,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('chambre/listroom.html.twig', [
            'Chambres' => $pagination
        ]);
    }

}