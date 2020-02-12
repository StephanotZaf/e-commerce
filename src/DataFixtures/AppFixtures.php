<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\Photo;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $categorie = new Categorie();
        $categorie->setLibelleCategorie('Blouson');

        $manager->persist($categorie);

        for($i=1;$i<=20;$i++){

            $faker = Factory::create('fr_FR');
            //$product = new Product();
            // $manager->persist($product);

            $fournisseur = new Fournisseur();
            $nomFourniss = $faker->firstName;
            $adresse = $faker->address;
            $phonenumber = $faker->phoneNumber;

            $fournisseur->setNomFournisseur($nomFourniss);
            $fournisseur->setAdresseFournisseur($adresse);
            $fournisseur->setNumeroTelephoneFournisseur($phonenumber);

            $manager->persist($fournisseur);



            $code = $faker->ean8;
            $libelle = $faker->name($gender = null);
            $promotion = $faker->boolean(10);

            $produit = new Produit();
            $produit->setCodeProduit($code)
                    ->setLibelleProduit($libelle)
                    ->setPrixUnitaireDetails(mt_rand(100,400))
                    ->setPrixUnitaireGros(mt_rand(80, 350))
                    ->setPromotion($promotion)
                    ->setFournisseur($fournisseur)
                    ->setCategorie($categorie);

            for($j=1; $j<=mt_rand(2, 3); $j++){
                $photo = new Photo();
                $photo->setUrl($faker->imageUrl())
                        ->setProduit($produit);
                $manager->persist($photo);
            }





            $manager->persist($produit);


        }


        $manager->flush();
    }
}
