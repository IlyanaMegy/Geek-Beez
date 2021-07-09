<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
   /**
     * @Route("/panier", name="panier")
     */
    public function panier(SessionInterface $session, ProduitRepository $produitrepo)
    {
        $panier = $session->get('panier', []);

        $panierdata = [];


        foreach($panier as $id => $quantity) {
            $panierdata[] = [
                'produit' => $produitrepo->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach($panierdata as $item){
            $totalItem = $item['produit']->getPrix() * $item['quantity'];
            $total ++;
        }

        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $id = $this->getUser()->getId();
            $gender = $this->getUser()->getGenre();
            $repository = $this->getDoctrine()->getRepository(Panier::class);
            $panier = $repository->findOneBy(['id' => $id]);

            return $this->render('panier.html.twig', [
                'controller_name' => 'GeekBeezController',
                'items' => $panierdata, 'genre' => $gender, 'panier' => $panier,
            ]);
        }
        $gender = NULL;

        return $this->render('panier.html.twig', [
            'controller_name' => 'GeekBeezController',
            'items' => $panierdata,'genre' => $gender, 'panier' => $panier,
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="add_to_panier")
     * 
     */
    public function add($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            $panier[$id]++;

        }else{
            $panier[$id]=1;
        }

        $produit_occur = $panier[$id];

        $session->set('panier', $panier);
        $this->get('session')->set('aBasket', $panier);
        dd($panier);

    }
}
