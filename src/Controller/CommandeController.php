<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Repository\CommandeRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(CartService $cartService, CommandeRepository $commandeRepository, Request $request)
    {
        $commande = new Commande();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commande);
        $produitCommander = $cartService->getFullCart();
        //dd($produitCommander);
        foreach ($produitCommander as $produit){
            $ligneCom = new LigneCommande();
            $ligneCom->setCommande($commande);
            //dd($produit['product']->getId());
            $ligneCom->setProduit($produit['product']);
            $ligneCom->setQuantiteCommande($produit['quantity']);
            $entityManager->persist($ligneCom);
        }
        $entityManager->flush();

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
}
