<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 100; $i++) {
            $entreprise = new Entreprise();
            $entreprise->setNom('Entreprise '.$i);
            $entreprise->setAdresse('Adresse '.$i);
            $manager->persist($entreprise);

            for ($j = 0; $j < rand(1, 150); $j++) {
                $client = new Client();
                $client->setPrenom('prénom '.$j);
                $client->setNom('Nom '.$j);
                $client->setEmail('email'.$j.'@mail.fr');
                $client->setEntreprise($entreprise);
                $manager->persist($client);
            }
        }

        $manager->flush();
    }
}
