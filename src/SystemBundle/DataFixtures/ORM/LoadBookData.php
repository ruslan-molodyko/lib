<?php

namespace SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SystemBundle\Entity\Book;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadBookData implements FixtureInterface, ContainerAwareInterface
{
    /** @var  ContainerInterface */
    public $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $book = new Book();

        $book->setTitle('Source');
        $book->setDescription('About all');
        $book->setIsbn(324234234);
        $book->setYear(1990);
        $book->setImage(null);

        $manager->persist($book);
        $manager->flush();
    }
}