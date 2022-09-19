<?php

namespace App\DataFixtures;

use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LevelFixtures extends Fixture
{
    public const LEVELS = [
            'Basics' => '#F6EFEF',
            'Novice' => '#69E508',
            'Intermediate' => '#0ED6E2',
            'Confirmed' => '#EEAF0C',
            'Expert' => '#F01919',
            'Master' => '#C608E5',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::LEVELS as $name => $color) {
            $level = new Level();
            $level->setName($name);
            $level->setColor($color);
            $this->addReference('level_' . $name, $level);
            $manager->persist($level);
        }
        $manager->flush();
    }
}
