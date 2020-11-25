<?php


namespace App\Controller;

use App\Entity\Argonautes;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Routing\Annotation\Route;


/**
 * @method createQueryBuilder()
 */
class DefaultController extends AbstractController
{

    /**
     * Page d'Accueil
     * @Route("/home", name="default_home", methods={"GET|POST"})
     * @param Request $request
     *
     * @return Response
     */
    public function home(Request $request, $list2) 
    {

        # Ajout d'un nouveau argonaute
        $argonaute = new Argonautes();

        # Création du Formulaire
        $form = $this->createFormBuilder($argonaute)
            ->add('nom', TextType::class, [
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
            
            ->findBy(array(),  null, 25, null);



        $qb = $this->createQueryBuilder($list2);

        $em = $qb->getEntityManager();

// example4: retrieve the DQL string of what was defined in QueryBuilder
        $dql = $qb->getDql();

// example5: retrieve the associated Query object with the processed DQL
        $q = $qb->getQuery();



    $qb->select('nom')
    ->from('argonautes')
    ->where('id')
    ->Between(1, 2);




            
         

        return $this->render("default/home.html.twig", [
            'form' => $form->createView(),
            'list' => $list,
            'list2' => $list2
            
        ]);
    }
}