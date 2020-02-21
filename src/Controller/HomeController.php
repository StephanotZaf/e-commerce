<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ProduitRepository $repo,CategorieRepository $repo1)
    {
        $produit = $repo->findByPromotion(1);
        $produitAll = $repo->findAllByStock(1);
        $category = $repo1->findAll();
        return $this->render('home/index.html.twig', [
            'produits' => $produit,
            'produitAlls' => $produitAll,
            'categoryAlls' => $category
        ]);
    }

}
