<?php

namespace App\DataFixtures;

use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LevelFixtures extends Fixture
{
    public const LEVELS = [
        [
            'name' => 'Basics',
            'color' => '#F6EFEF',
        ],
        [
            'name' => 'Novice',
            'color' => '#69E508',
        ],
        [
            'name' => 'Intermediate',
            'color' => '#0ED6E2',
        ],
        [
            'name' => 'Confirmed',
            'color' => '#EEAF0C',
        ],
        [
            'name' => 'Expert',
            'color' => '#F01919',
        ],
        [
            'name' => 'Master',
            'color' => '#C608E5',
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::LEVELS as $levelItems) {
            $level = new Level();
            $level->setName($levelItems['name']);
            $level->setColor($levelItems['color']);
            $manager->persist($level);
        }
        $manager->flush();
    }
}
