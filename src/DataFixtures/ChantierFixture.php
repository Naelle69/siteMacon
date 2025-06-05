<?php

namespace App\DataFixtures;

use App\Entity\Chantiers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class ChantierFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Initialisation de Faker
        $faker = FakerFactory::create('fr_FR');

        // Liste des images disponibles
        $images = [
            'bathroom-1336164_640.jpg',
            'bathroom-1597027_640.jpg',
            'bathroom-6686057_640.jpg',
            'bricks-2181920_640.jpg',
            'home-2404521_640.jpg',
            'kitchen-5139610_640.jpg',
        ];

        // Dossiers d'images
        $dossierPrincipal = '/images/chantiers/';
        $dossierCarrousel = '/images/services/';

        // Génération de 5 chantiers
for ($i = 0; $i < count($images); $i++) {
    $chantier = new Chantiers();

    $imagePrincipale = $dossierPrincipal . $images[$i];

    // Carrousel (autres images sauf l'image principale)
    $carrouselImages = [];
    foreach (array_slice($images, 0, 4) as $key => $image) {
        $carrouselImages[] = $dossierCarrousel . $image;
    }

    $chantier->setNom("Chantier n°" . ($i + 1));
    $chantier->setDescription($faker->sentence(5));
    $chantier->setImagePrincipale($imagePrincipale);
    $chantier->setCarrouselImages($carrouselImages);

    $manager->persist($chantier);
}


        // Enregistrement final
        $manager->flush();
    }
}