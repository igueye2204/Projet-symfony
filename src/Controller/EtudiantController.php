<?php

    namespace App\Controller;
    use App\Entity\Etudiant;
    use App\Form\EtudiantType;
    use App\Repository\EtudiantRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class EtudiantController extends AbstractController
    {
        /**
         * @Route("/etudiant", name="etudiant")
         */
        public function index()
        {
            return $this->render('etudiant/index.html.twig', [
                'controller_name' => 'EtudiantController',
            ]);
        }

        /**
         * @Route("/", name="home")
         */
        public function home() {
            return $this->render('etudiant/home.html.twig');
        }

        /**
         * @Route("/etudiant/addstudent", name="addstudent")
         */
        public function addstudent( Request $request, EntityManagerInterface $em) :Response{
            $rp= $em->getRepository(Etudiant::class);
            $nbrField=count($rp->findAll()) ;
            $etudiant = new Etudiant();
            $formEtudiant = $this->createForm(EtudiantType::class, $etudiant);
            $formEtudiant->handleRequest($request);
            if($formEtudiant->isSubmitted() && $formEtudiant->isValid() ) {

                $em->persist($etudiant);
                $em->flush();
            }

            return $this->render('etudiant/addstudent.html.twig', [
                'formEtudiant'=>$formEtudiant->createView(),
                'nbrField'=>$nbrField
            ]);
        }

        /**
         * @Route("/etudiant/{id<[0-9]+>}/updatestudent", name="updatestudent", methods={"POST","GET"})
         */
        public function updatestudent( Request $request, EntityManagerInterface $em, Etudiant $etudiant) :Response{
            $rp= $em->getRepository(Etudiant::class);
            $nbrField=count($rp->findAll());
            $formEtudiant = $this->createForm(EtudiantType::class, $etudiant);
            $formEtudiant->handleRequest($request);
            if($formEtudiant->isSubmitted() && $formEtudiant->isValid() ) {
                $em->flush();
                return $this->redirectToRoute('liststudent');
            }
            return $this->render('etudiant/addstudent.html.twig', [
                'formEtudiant'=>$formEtudiant->createView(),
                'nbrField'=>$nbrField
            ]);
        }


        /**
         * @Route("/etudiant/{id<[0-9]+>}/deletestudent", name="deletestudent")
         */
        public function deletestudent(EntityManagerInterface $em, Etudiant $etudiant)
        {
            $em->remove($etudiant);
            $em->flush();
            return $this->redirectToRoute('liststudent');
        }


        /**
         * @Route("/etudiant/liststudent", name="liststudent")
         */
        public function liststudent( EtudiantRepository $repo, Request $request ): Response {



            $etudiants = $repo->findAll(); // Afficher l'intégralité de l'entité Chambre

            return $this->render('etudiant/liststudent.html.twig', [
                'Etudiants' => $etudiants
            ]);
        }

    }