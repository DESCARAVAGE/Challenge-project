<?php

namespace App\DataFixtures;

use App\Entity\Challenge;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;

class ChallengeFixtures extends Fixture implements DependentFixtureInterface
{
    public const CHALLENGE_NUMBER = 8;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::CHALLENGE_NUMBER; $i++) {
            $challenge = new Challenge();

            $challenge->setName($faker->name());
            $challenge->setDate($faker->dateTime());
            $typeName = array_rand(TypeFixtures::TYPES);
            $challenge->setType($this->getReference('type_' . $typeName));
            $manager->persist($challenge);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TypeFixtures::class,
        ];
    }
}
