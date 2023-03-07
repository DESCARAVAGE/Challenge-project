<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USE_NUMBER = 10;

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $member = new User();
        $member->setUsername(('Dany'));
        $password = $this->hasher->hashPassword($member, 'member');
        $member->setPassword($password);
        $member->setRoles(['ROLE_USER']);
        $manager->persist($member);
        $this->addReference('Dany', $member);

        for ($i = 0; $i < self::USE_NUMBER; $i++) {
            $member = new User();
            $member->setUsername($faker->name());
            $password = $this->hasher->hashPassword($member, 'member');
            $member->setPassword($password);
            $member->setRoles(['ROLE_USER']);
            $manager->persist($member);
            $this->addReference('user_' . $i, $member);
        }
        $manager->flush();
    }
}
