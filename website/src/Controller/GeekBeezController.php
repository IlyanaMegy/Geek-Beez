<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Membres;
use App\Form\MembresType;
use App\Entity\Panier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class GeekBeezController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function __invoke(): Response
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {

            $id = $this->getUser()->getId();

            $repository = $this->getDoctrine()->getRepository(Panier::class);
            $panier = $repository->findOneBy(['id' => $id]);

            return $this->render('accueil.html.twig', [
                'controller_name' => 'GeekBeezController',
                'panier' => $panier,
            ]);


        }
        $panier = NULL;
        return $this->render('accueil.html.twig', [
            'controller_name' => 'GeekBeezController',
            'panier' => $panier,
        ]);
        

    }

    /**
     * @Route("/produits", name="produits")
     */
    public function products(): Response
    {
        return $this->render('products.html.twig', [
            'controller_name' => 'GeekBeezController',
        ]);
    }

    /**
     * @Route("/parrainage", name="parrainage")
     */
    public function sponsor(): Response
    {
        return $this->render('sponsor.html.twig', [
            'controller_name' => 'GeekBeezController',
        ]);
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function profil(): Response
    {
        return $this->render('profil.html.twig', [
            'controller_name' => 'GeekBeezController',
        ]);
    }

    /**
    * @Route("/service", name="service")
    */
    public function service(): Response
    {
        return $this->render('service.html.twig', [
            'controller_name' => 'GeekBeezController',
        ]);
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function shop(): Response
    {
        return $this->render('shop.html.twig', [
            'controller_name' => 'GeekBeezController',
        ]);
    }
}
