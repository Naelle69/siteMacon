<?php

namespace App\DataFixtures;

use App\Entity\Chantiers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ChantierFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Liste des images disponibles
        $images = [
            'architecture-257960_640.jpg',
            'fond crepi hp.jpg',
            'luxury-home-2412145_1280.jpg',
            'paint-brush-1034901_640.jpg',
            'purchase-313198_640.jpg',
            'real-estate-955483_640.jpg',
            'straubing-8669480_640.jpg',
        ];

        // Générateur de données fictives
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 5; $i++) {
            // Choisis une image principale aléatoire
            $imagePrincipale = '/images/services/' . array_rand($images);

            // Choisis des images de carrousel aléatoires
            $carrouselImages = [];
            for ($j = 0; $j < 4; $j++) {
                $carrouselImages[] = '/images/services/' . $images[array_rand($images)];
            }

            // Crée le chantier
            $chantier = new Chantiers();
            $chantier->setNom("Chantier n°$i");
            $chantier->setDescription($faker->sentence(5)); // Description aléatoire
            $chantier->setImagePrincipale($imagePrincipale);
            $chantier->setCarrouselImages($carrouselImages);

            $manager->persist($chantier);
        }

        $manager->flush();
    }
}