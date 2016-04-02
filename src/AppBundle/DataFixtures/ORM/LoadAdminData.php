<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Admin;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAdminData implements FixtureInterface, ContainerAwareInterface
{
    /** @var  ContainerInterface */
    public $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();

        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($admin, '123456');

        $admin
            ->setEmail('admin@gmail.com')
            ->setPassword($encoded);

        $manager->persist($admin);
        $manager->flush();
    }
}