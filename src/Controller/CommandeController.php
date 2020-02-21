<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(CartService $cartService, CommandeRepository $commandeRepository, Request $request, ProduitRepository $produitRepository)
    {
        $commande = new Commande();
        $commande->setClient($this->getUser());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commande);
        $produitCommander = $cartService->getFullCart();
        //dd($this->getUser());
        //dd($produitCommander);
        foreach ($produitCommander as $produit){
            $identifiant = $produit['product']->getId();
            $qteDispo = $produit['product']->getStock();
            $qteDemande = $produit['quantity'];

            $product = $produitRepository->find($identifiant);

            if (!$product) {
                throw $this->createNotFoundException(
                    'Produit introuvable '.$identifiant
                );
            }
            $product->setStock($qteDispo - $qteDemande);

            $ligneCom = new LigneCommande();
            $ligneCom->setCommande($commande);
            //dd($produit['product']->getId());
            $ligneCom->setProduit($produit['product']);
            $ligneCom->setQuantiteCommande($qteDemande);
            $entityManager->persist($ligneCom);
            $cartService->remove($produit['product']->getId());
        }
        $entityManager->flush();

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
}
