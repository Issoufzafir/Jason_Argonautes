<?php


namespace App\Controller;

use App\Entity\Argonautes;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormTypeInterface;

use Symfony\Component\Routing\Annotation\Route;



class DefaultController extends AbstractController
{

    /**
     * Page d'Accueil
     * @Route("/", name="default_home", methods={"GET|POST"})
     * @param Request $request
     *
     * @return Response
     */
    public function home(Request $request)
    {

        # Ajout d'un nouveau argonaute
        $argonaute = new Argonautes();

        # Création du Formulaire
        $form = $this->createFormBuilder($argonaute)
            ->add('nom', TextType::class, [
                'label' => false,

                
            ])
            ->add('id',IntegerType::class, [
                'label' => false,
            ])

            # Bouton Valider
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])
            ->getForm();

            $form->handleRequest($request);

            # Traitement du Formulaire
        if ($form->isSubmitted() && $form->isValid()) {





            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($argonaute);
            $em->flush();

            

            # Redirection
            return $this->redirectToRoute('default_home');

        }

        $list = $this->getDoctrine()
            
            ->getRepository(Argonautes::class)
            
            ->recherche('id');

        $list2 = $this->getDoctrine()

            ->getRepository(Argonautes::class)

            ->recherche2('id');

        $list3 = $this->getDoctrine()

            ->getRepository(Argonautes::class)

            ->recherche3('id');









            
         

        return $this->render("default/home.html.twig", [
            'form' => $form->createView(),
            'list' => $list,
            'list2' => $list2,
            'list3' => $list3,

            
        ]);
    }
}