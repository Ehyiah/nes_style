<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $password = $this->encoder->encodePassword($user, 'coucou');
        $user->setPassword($password);
        $user->setUsername('matthieu');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $user = new User();
        $password = $this->encoder->encodePassword($user, 'coucou');
        $user->setPassword($password);
        $user->setRoles(['ROLE_CONTRIB']);
        $user->setUsername('kristel');
        $manager->persist($user);

        $manager->flush();
    }
}
