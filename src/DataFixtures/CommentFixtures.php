<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Service\Slugify;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public const COMMENT_NUMBER = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($j = 0; $j < ChallengeFixtures::CHALLENGE_NUMBER; $j++) {
            $challenge = $this->getReference('challenge_' . $j);
            for ($i = 0; $i < self::COMMENT_NUMBER; $i++) {
                $comment = new Comment();
                $comment->setMessage($faker->text());
                $comment->setAuthor($this->getReference('user_' . rand(0, UserFixtures::USE_NUMBER - 1)));
                $comment->setChallenge($challenge);

                $manager->persist($comment);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ChallengeFixtures::class,
        ];
    }
}
