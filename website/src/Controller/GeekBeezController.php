<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Membres;
use App\Form\MembresType;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
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
            $gender = $this->getUser()->getGenre();
            $repository = $this->getDoctrine()->getRepository(Panier::class);
            $panier = $repository->findOneBy(['id' => $id]);

            return $this->render('accueil.html.twig', [
                'controller_name' => 'GeekBeezController',
                'panier' => $panier, 'genre' => $gender
            ]);
        }
        $panier = NULL;
        $gender = NULL;
        return $this->render('accueil.html.twig', [
            'controller_name' => 'GeekBeezController',
            'panier' => $panier,'genre' => $gender
        ]);
    }

    /**
     * @Route("/boutique", name="shop")
     */
    public function boutique(): Response
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {

            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            $repository = $this->getDoctrine()->getRepository(Panier::class);
            $panier = $repository->findOneBy(['id' => $id]);

            return $this->render('shop.html.twig', [
                'controller_name' => 'GeekBeezController',
                'panier' => $panier, 'genre' => $gender
            ]);
        }
        $panier = NULL;
        $gender = NULL;
        return $this->render('shop.html.twig', [
            'controller_name' => 'GeekBeezController',
            'panier' => $panier,'genre' => $gender
        ]);
    }

    /**
     * @Route("/boutique/bien_etre", name="bien_etre")
     */
    public function bien_etre(ProduitRepository $repo): Response
    {   $produits = $repo->findAll();
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {

            
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            $repository = $this->getDoctrine()->getRepository(Panier::class);
            $panier = $repository->findOneBy(['id' => $id]);

            return $this->render('bien_etre.html.twig', [
                'controller_name' => 'GeekBeezController',
                'panier' => $panier, 'genre' => $gender, 'produits' => $produits
            ]);
        }
        $panier = NULL;
        $gender = NULL;

        return $this->render('bien_etre.html.twig', [
            'controller_name' => 'GeekBeezController',
            'panier' => $panier,'genre' => $gender, 'produits' => $produits
        ]);
    }

    /**
     * @Route("/boutique/bien_etre/{slug}", name="produit_bien_etre")
     */
    public function show(Produit $produit){

        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {

            
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            $repository = $this->getDoctrine()->getRepository(Panier::class);
            $panier = $repository->findOneBy(['id' => $id]);

            return $this->render('produit.html.twig', [
                'controller_name' => 'GeekBeezController',
                'panier' => $panier, 'genre' => $gender, 'produit' => $produit
            ]);
        }
        $panier = NULL;
        $gender = NULL;

        return $this->render('produit.html.twig', [
            'controller_name' => 'GeekBeezController',
            'panier' => $panier,'genre' => $gender, 'produit' => $produit
        ]);
    }



    // public function ptit_miam(ProduitRepository $repo): Response
    // {   $produits = $repo->findAll();
    //     if($this->isGranted('IS_AUTHENTICATED_FULLY'))
    //     {

            
    //         $id = $this->getUser()->getId();
    //         $gender = $this->getUser()->getGenre();
    //         $repository = $this->getDoctrine()->getRepository(Panier::class);
    //         $panier = $repository->findOneBy(['id' => $id]);

    //         return $this->render('ptit_miam.html.twig', [
    //             'controller_name' => 'GeekBeezController',
    //             'panier' => $panier, 'genre' => $gender, 'produits' => $produits
    //         ]);
    //     }
    //     $panier = NULL;
    //     $gender = NULL;

    //     return $this->render('ptit_miam.html.twig', [
    //         'controller_name' => 'GeekBeezController',
    //         'panier' => $panier,'genre' => $gender, 'produits' => $produits
    //     ]);
    // }

    // /**
    //  * @Route("/boutique/ptit_miam/{slug}", name="produit_ptit_miam")
    //  */
    // public function show(Produit $produit){
        
    // }


    
    // /**
    //  * @Route("/boutique/gadget", name="gadget")
    //  */

    // public function gadget(ProduitRepository $repo): Response
    // {   $produits = $repo->findAll();
    //     if($this->isGranted('IS_AUTHENTICATED_FULLY'))
    //     {

            
    //         $id = $this->getUser()->getId();
    //         $gender = $this->getUser()->getGenre();
    //         $repository = $this->getDoctrine()->getRepository(Panier::class);
    //         $panier = $repository->findOneBy(['id' => $id]);

    //         return $this->render('gadget.html.twig', [
    //             'controller_name' => 'GeekBeezController',
    //             'panier' => $panier, 'genre' => $gender, 'produits' => $produits
    //         ]);
    //     }
    //     $panier = NULL;
    //     $gender = NULL;

    //     return $this->render('gadget.html.twig', [
    //         'controller_name' => 'GeekBeezController',
    //         'panier' => $panier,'genre' => $gender, 'produits' => $produits
    //     ]);
    // }

    // /**
    //  * @Route("/boutique/gadget/{slug}", name="produit_gadget")
    //  */
    // public function show(Produit $produit){
        
    // }


      
    // /**
    //  * @Route("/boutique/skins", name="skins")
    //  */

    // public function skins(ProduitRepository $repo): Response
    // {   $produits = $repo->findAll();
    //     if($this->isGranted('IS_AUTHENTICATED_FULLY'))
    //     {

            
    //         $id = $this->getUser()->getId();
    //         $gender = $this->getUser()->getGenre();
    //         $repository = $this->getDoctrine()->getRepository(Panier::class);
    //         $panier = $repository->findOneBy(['id' => $id]);

    //         return $this->render('skins.html.twig', [
    //             'controller_name' => 'GeekBeezController',
    //             'panier' => $panier, 'genre' => $gender, 'produits' => $produits
    //         ]);
    //     }
    //     $panier = NULL;
    //     $gender = NULL;

    //     return $this->render('skins.html.twig', [
    //         'controller_name' => 'GeekBeezController',
    //         'panier' => $panier,'genre' => $gender, 'produits' => $produits
    //     ]);
    // }

    // /**
    //  * @Route("/boutique/skins/{slug}", name="skins")
    //  */
    // public function show(Produit $produit){
        
    // }


      
    // /**
    //  * @Route("/boutique/phares", name="phares")
    //  */

    // public function phares(ProduitRepository $repo): Response
    // {   $produits = $repo->findAll();
    //     if($this->isGranted('IS_AUTHENTICATED_FULLY'))
    //     {

            
    //         $id = $this->getUser()->getId();
    //         $gender = $this->getUser()->getGenre();
    //         $repository = $this->getDoctrine()->getRepository(Panier::class);
    //         $panier = $repository->findOneBy(['id' => $id]);

    //         return $this->render('phares.html.twig', [
    //             'controller_name' => 'GeekBeezController',
    //             'panier' => $panier, 'genre' => $gender, 'produits' => $produits
    //         ]);
    //     }
    //     $panier = NULL;
    //     $gender = NULL;

    //     return $this->render('phares.html.twig', [
    //         'controller_name' => 'GeekBeezController',
    //         'panier' => $panier,'genre' => $gender, 'produits' => $produits
    //     ]);
    // }

    // /**
    //  * @Route("/boutique/phares/{slug}", name="phares")
    //  */
    // public function show(Produit $produit){
        
    // }



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
