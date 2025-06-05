<?php

namespace App\DataFixtures;

use App\Entity\Avis;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class AvisFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        for ($i = 0; $i < 6; $i++) {
            $avis = new Avis();
            $avis->setNomClient($faker->name);
            $avis->setLieu($faker->city);
            $avis->setCommentaire($faker->paragraph);
            $avis->setNote(random_int(1, 5));

            $manager->persist($avis);
        }

        $manager->flush();
    }
}
