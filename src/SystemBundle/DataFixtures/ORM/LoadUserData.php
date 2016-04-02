<?php

namespace SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SystemBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /** @var  ContainerInterface */
    public $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, '123456');

        $user
            ->setEmail('molodyko13@gmail.com')
            ->setPassword($encoded);

        $manager->persist($user);

        $user = new User();

        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, '123456');

        $user
            ->setEmail('molodyko15@gmail.com')
            ->setPassword($encoded);

        $manager->persist($user);

        $manager->flush();
    }
}