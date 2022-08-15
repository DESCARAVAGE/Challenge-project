<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public const LANGUAGES = [
        [
            'name' => 'PHP',
            'image' => '../images/Languages_Logo/Logo_PHP.png',
        ],
        [
            'name' => 'JavaScript',
            'image' => '/images/Languages_Logo/Logo_',
        ],
        [
            'name' => 'JAVA',
            'image' => 'images/Languages_Logo/Logo_',
        ],
        [
            'name' => 'Python',
            'image' => '../images/Languages_Logo/Logo_',
        ],
        [
            'name' => 'Angular',
            'image' => '../images/Languages_Logo/Logo_',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::LANGUAGES as $languageItems) {
            $languages = new Language();
            $languages->setName($languageItems['name']);
            $languages->setImage($languageItems['image']);
            $manager->persist($languages);
        }
        $manager->flush();
    }
}
