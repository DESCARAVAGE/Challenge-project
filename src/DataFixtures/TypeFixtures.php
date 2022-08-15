<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public const TYPES = [
        [
            'name' => 'Front',
        ],
        [
            'name' => 'Back',
        ],
        [
            'name' => 'Full stack',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TYPES as $typeItems) {
            $type = new Type();
            $type->setName($typeItems['name']);
            $manager->persist($type);
        }
        $manager->flush();
    }
}
