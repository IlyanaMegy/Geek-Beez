<?php
//https://dev.to/qferrer/managing-the-cart-storage-building-a-shopping-cart-with-symfony-57o6#cart-manager0
namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Manager\CartManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\AddToCartType;

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

            return $this->render('accueil.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender
            ]);
        }else{
           $gender = NULL;        
        }
        return $this->render('accueil.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender
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
            

            return $this->render('shop.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender
            ]);
        }else{
           $gender = NULL;        
        }
        return $this->render('shop.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 
        ]);
    }


    /**
     * @Route("/boutique/bien_etre", name="bien_etre")
     */
    public function bien_etre(ProduitRepository $repo): Response
    {   
        $produits = $repo->findBy(
            ['categorie' => '1'],
            ['prix' => 'ASC']
        );
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            

            return $this->render('category.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
            ]);
        }else{
           $gender = NULL;        
        }
        

        return $this->render('category.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
        ]);
    }

    /**
     * @Route("/boutique/bien_etre/{slug}", name="produit_bien_etre")
     */
    public function produit_bien_etre(Produit $produit,  Request $request,  CartManager $cartManager)
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
        }else{
           $gender = NULL;     
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setProduit($produit);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addItem($item)
                ->setUpdatedAt(new \DateTime());

            $cartManager->save($cart);
            return $this->redirectToRoute('produit_bien_etre',['slug' => $produit->getSlug()]);
        }

        return $this->render('produit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
            'controller_name' => 'GeekBeezController',
            'genre' => $gender,
        ]); 
    }


    /**
     * @Route("/boutique/petit_miam", name="petit_miam")
     */
    public function petit_miam(ProduitRepository $repo): Response
    {   
        
        $produits = $repo->findBy(
            ['categorie' => '2'],
            ['prix' => 'ASC']
        );
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            

            return $this->render('category.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
            ]);
        }else{
           $gender = NULL;        
        }
        

        return $this->render('category.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
        ]);
    }

    /**
     * @Route("/boutique/petit_miam/{slug}", name="produit_petit_miam")
     */
    public function produit_petit_miam(Produit $produit){
        
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            

            return $this->render('produit.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender, 'produit' => $produit
            ]);
        }else{
           $gender = NULL;        
        }
        

        return $this->render('produit.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 'produit' => $produit
        ]);
    }



    /**
     * @Route("/boutique/gadget", name="gadget")
     */
    public function gadget(ProduitRepository $repo): Response
    {   
        $produits = $repo->findBy(
            ['categorie' => '3'],
            ['prix' => 'ASC']
        );
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            

            return $this->render('category.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
            ]);
        }else{
           $gender = NULL;        
        }
        

        return $this->render('category.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
        ]);
    }

    /**
     * @Route("/boutique/gadget/{slug}", name="produit_gadget")
     */
    public function produit_gadget(Produit $produit){
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            

            return $this->render('produit.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender, 'produit' => $produit
            ]);
        }else{
           $gender = NULL;        
        }
        

        return $this->render('produit.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 'produit' => $produit
        ]);
    }


    /**
     * @Route("/boutique/skins", name="skins")
     */
    public function skins(ProduitRepository $repo): Response
    {   
        $produits = $repo->findBy(
            ['categorie' => '4'],
            ['prix' => 'ASC']
        );
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            

            return $this->render('category.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
            ]);
        }else{
           $gender = NULL;        
        }
        
        return $this->render('category.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
        ]);
    }

    /**
     * @Route("/boutique/skins/{slug}", name="produit_skins")
     */
    public function produit_skins(Produit $produit){
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            

            return $this->render('produit.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender, 'produit' => $produit
            ]);
        }else{
           $gender = NULL;        
        }
        

        return $this->render('produit.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 'produit' => $produit
        ]);
    }



    /**
     * @Route("/boutique/phares", name="phares")
     */
    public function phares(ProduitRepository $repo): Response
    {   
        $produits = $repo->findBy(
            ['categorie' => '5'],
            ['prix' => 'ASC']
        );
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            

            return $this->render('category.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
            ]);
        }else{
           $gender = NULL;        
        }
        

        return $this->render('category.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 'produits' => $produits
        ]);
    }
    /**
     * @Route("/boutique/phares/{slug}", name="produit_phares")
     */
    public function produit_phares(Produit $produit){
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            

            return $this->render('produit.html.twig', [
                'controller_name' => 'GeekBeezController','genre' => $gender, 'produit' => $produit
            ]);
        }else{
           $gender = NULL;        
        }
        return $this->render('produit.html.twig', [
            'controller_name' => 'GeekBeezController','genre' => $gender, 'produit' => $produit
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
}
