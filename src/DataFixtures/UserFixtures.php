<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



 class UserFixtures extends Fixture
{
    private $encoder;

public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder = $encoder;
}

    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setUsername('mayajolie');
        $password = $this->encoder->encodePassword($user, 'mayajolie');
        $user->setPassword($password);
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $user->setNom('ngom');
        $user->setPrenom('mariama');
        $user->setAdresse('parcelle');
        $user->setTelephone(772918604);
        $user->setEmail('maya@gmail.com');
        $user->setEtat('');
        
        
        $manager->persist($user);
        $manager->flush();
    }
}
