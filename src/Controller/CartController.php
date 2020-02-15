<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CartService $cartService)
    {
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' =>$cartService->getTotal()
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartservice)
    {
        $cartservice->add($id);
        return $this->redirectToRoute("cart_index");

    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartservice){
        $cartservice->remove($id);
        return $this->redirectToRoute("cart_index");

    }

    /**
     * decrementer le nombre d'article choisi
     * @Route("/panier/decrem/{id}", name="cart_dec")
     */
    public function dec($id, CartService $cartservice){
        $cartservice->dec($id);
        return $this->redirectToRoute("cart_index");
    }
}
