<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
            /* for ($i = 1; $i <= 5; $i++) {
            $service= new Service();
            $service->setNom("Service : " . $i);
            
            $manager->persist($service); 
        }*/

        $noms = [
            'Peintures',
            'Carrelage',
            'Réalisation des fondations',
            'Isolation',
            'Consulting',
        ];

        $descriptions = [
            'Spécialiste en travaux de peinture intérieure et extérieure, nous offrons des finitions impeccables avec des matériaux de qualité adaptés à vos besoins. De la préparation des surfaces à la pose finale, notre équipe garantit un rendu esthétique et durable.',
            
            'Expertise dans la pose de carrelage mural et au sol, qu’il s’agisse de céramique, de grès cérame ou de pierre naturelle. Nous intervenons dans les cuisines, salles de bain, espaces commerciaux et bien plus encore, avec précision et soin.',
            
            'Exécution complète des fondations en béton armé, y compris le terrassement, le coffrage, le ferraillage et le coulage. Des bases solides pour garantir la stabilité et la sécurité de toute construction résidentielle ou commerciale.',
            
            'Solutions d\'isolation thermique et acoustique performantes pour optimiser le confort et réduire les coûts énergétiques. Notre expertise englobe l’isolation des murs, combles, toitures et planchers, avec des matériaux écologiques et efficaces.',
            
            'Accompagnement stratégique dans la transformation digitale de votre entreprise : audit, conseil personnalisé, intégration d’outils numériques, formation et accompagnement au changement pour maximiser votre performance et votre visibilité.'
        ];

        // Tableau des noms d'images correspondant aux services
        $images = [
            'paint-brush-1034901_640.jpg',
            'kitchen-1336160_640.jpg',
            'fondations-1799115_640.jpg',
            'architecture-257960_640.jpg',
            'purchase-3113198_640.jpg',
        ];
        
// Associer chaque service à son nom, sa description et son image
        foreach ($noms as $index => $nom) {
            $service = new Service();
            $service->setNom($nom);
            $service->setDescription($descriptions[$index]);
            $service->setImage($images[$index]);

            $manager->persist($service);

            $manager->flush();
        }
    }
}
