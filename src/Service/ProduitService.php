<?php
namespace App\Service;

use App\Repository\ProduitRepository;

class ProduitService{
    protected $produitRepository;

public function __construct(ProduitRepository $produitRepository){
    $this->produitRepository = $produitRepository;
}


}