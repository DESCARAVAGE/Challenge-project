<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LanguageFixtures extends Fixture
{
    public const LANGUAGES = [
        'Angular' => './build/images/Languages_Logo/Logo_Angular.22a64a69.jpg',
        'Java' => './build/images/Languages_Logo/Logo_JAVA.0a13d20e.jpg',
        'JS' => './build/images/Languages_Logo/Logo_JS.f2d3a24e.png',
        'PHP' => './build/images/Languages_Logo/Logo_Python.e11e70d4.png',
        'Python' => './build/images/Languages_Logo/Logo_Python.e11e70d4.png'

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::LANGUAGES as $name => $image) {
            $languages = new Language();

            $languages->setName($name);
            $languages->setImage($image);
            $this->addReference('languages_' . $name, $languages);
            $manager->persist($languages);
        }
        $manager->flush();
    }
}
