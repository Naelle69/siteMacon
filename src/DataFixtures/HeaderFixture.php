<?php

namespace App\DataFixtures;

use App\Entity\Header;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HeaderFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Exemple de headers pour différentes pages
        $headers = [
            [
                'titre' => 'Artisan Maçon à Lyon – Construction & Rénovation',
                'sousTitre' => 'Notre passion: la qualité'
            ]
        ];

        foreach ($headers as $data) {
            $header = new Header();
            $header->setTitre($data['titre']);
            $header->setSousTitre($data['sousTitre']);

            $manager->persist($header);
        }

        $manager->flush();
    }
}