<?php

namespace App\Controller;

use App\Entity\PointDeVente;
use App\Form\PointDeVenteType;
use App\Repository\PointDeVenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/point/de/vente")
 */
class PointDeVenteController extends AbstractController
{
    /**
     * @Route("/", name="point_de_vente_index", methods={"GET"})
     */
    public function index(PointDeVenteRepository $pointDeVenteRepository): Response
    {
        return $this->render('point_de_vente/index.html.twig', [
            'point_de_ventes' => $pointDeVenteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="point_de_vente_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pointDeVente = new PointDeVente();
        $form = $this->createForm(PointDeVenteType::class, $pointDeVente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pointDeVente);
            $entityManager->flush();

            return $this->redirectToRoute('point_de_vente_index');
        }

        return $this->render('point_de_vente/new.html.twig', [
            'point_de_vente' => $pointDeVente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="point_de_vente_show", methods={"GET"})
     */
    public function show(PointDeVente $pointDeVente): Response
    {
        return $this->render('point_de_vente/show.html.twig', [
            'point_de_vente' => $pointDeVente,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="point_de_vente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PointDeVente $pointDeVente): Response
    {
        $form = $this->createForm(PointDeVenteType::class, $pointDeVente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('point_de_vente_index');
        }

        return $this->render('point_de_vente/edit.html.twig', [
            'point_de_vente' => $pointDeVente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="point_de_vente_delete", methods={"POST"})
     */
    public function delete(Request $request, PointDeVente $pointDeVente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pointDeVente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pointDeVente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('point_de_vente_index');
    }
}
