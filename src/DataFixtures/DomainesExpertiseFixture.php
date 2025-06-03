<?php

namespace App\DataFixtures;

use App\Entity\DomainesExpertise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DomainesExpertiseFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $domaines = [
            [
                'nom' => 'Construction neuve',
                'description' => 'Bâtiments résidentiels ou commerciaux : fondations, élévation, chapes et structures en béton armé.',
                'icone' => 'bi-building',
                'couleurIcone' => '#0d6efd'
            ],
            [
                'nom' => 'Rénovation & restauration',
                'description' => 'Réparation de murs, ravalement de façades, isolation thermique et rénovation de bâtiments anciens.',
                'icone' => 'bi-tools',
                'couleurIcone' => '#0d6efd'
            ],
            [
                'nom' => 'Aménagements extérieurs',
                'description' => 'Terrasses, escaliers, murs de soutènement, allées et clôtures en matériaux durables.',
                'icone' => 'bi-ladder',
                'couleurIcone' => '#0d6efd'
            ],
            [
                'nom' => 'Maçonnerie intérieure',
                'description' => 'Création ou suppression de cloisons, préparation des sols et supports pour finitions.',
                'icone' => 'bi-bricks',
                'couleurIcone' => '#0d6efd'
            ],
            [
                'nom' => 'Enduits & finitions',
                'description' => 'Pose d\'enduits traditionnels ou décoratifs (ciment, chaux, plâtre), crépis et béton ciré.',
                'icone' => 'bi-paint-bucket',
                'couleurIcone' => '#0d6efd'
            ],
            [
                'nom' => 'Carrelage & dallage',
                'description' => 'Pose précise de carrelages, dalles et pavés, intérieur comme extérieur, y compris les zones humides.',
                'icone' => 'bi-border-all',
                'couleurIcone' => '#0d6efd'
            ],
        ];

        foreach ($domaines as $data) {
            $domaine = new DomainesExpertise();
            $domaine->setNom($data['nom']);
            $domaine->setDescription($data['description']);
            $domaine->setIcone($data['icone']);
            $domaine->setCouleurIcone($data['couleurIcone']);

            $manager->persist($domaine);
        }

        $manager->flush();
    }
}