<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixtures extends Fixture
{
    public const TYPES = [
            "Front",
            "Back",
            "Full stack"
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TYPES as $typeItems) {
            $type = new Type();
            $type->setName($typeItems);
            $this->addReference('type_' . $typeItems, $type);
            $manager->persist($type);
        }
        $manager->flush();
    }
}
