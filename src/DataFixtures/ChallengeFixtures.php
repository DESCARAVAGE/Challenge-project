<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Service\Slugify;
use App\Entity\Challenge;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ChallengeFixtures extends Fixture implements DependentFixtureInterface
{
    public const CHALLENGE_NUMBER = 8;

    public const IMAGE_CHALLENGE = [
        './build/images/challenge_image/info1.d4e5a4a3.jpeg',
        './build/images/challenge_image/info2.914ea96f.jpeg',
        './build/images/challenge_image/info3.354fcc8b.jpg',
        './build/images/challenge_image/info4.83ef8939.jpeg',
        './build/images/challenge_image/info5.17b5ec8f.jpeg',
        './build/images/challenge_image/info6.2361fbdf.jpeg',
        './build/images/challenge_image/info7.9029da35.jpeg',
        './build/images/challenge_image/info8.67e04780.jpeg',
    ];

    private Slugify $slugify;
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::CHALLENGE_NUMBER; $i++) {
            $challenge = new Challenge();

            $challenge->setName($faker->name());
            $challenge->setImage(self::IMAGE_CHALLENGE[$i]);
            $typeName = TypeFixtures::TYPES[array_rand(TypeFixtures::TYPES)];
            $challenge->setType($this->getReference('type_' . $typeName));
            $challenge->setDate($faker->dateTime());
            $challenge->setDescription($faker->sentence(100));
            $levelName = array_rand(LevelFixtures::LEVELS);
            $challenge->setLevel($this->getReference('level_' . $levelName));
            $languageName = array_rand(LanguageFixtures::LANGUAGES);
            $challenge->addLanguage($this->getReference('languages_' . $languageName));
            $challenge->setCatchPhrase($faker->sentences(3, true));
            $challenge->setSlug($this->slugify->generate($challenge->getName()));
            $manager->persist($challenge);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TypeFixtures::class,
            LevelFixtures::class,
            LanguageFixtures::class,
        ];
    }
}
