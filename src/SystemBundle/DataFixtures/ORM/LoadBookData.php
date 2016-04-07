<?php

namespace SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use SystemBundle\Entity\Book;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadBookData implements FixtureInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        for ($i = 5; $i--;) {

            $book = new Book();

            $book->setTitle('Source' . $i);
            $book->setDescription('About all');
            $book->setIsbn(324234234);
            $book->setYear(new \DateTime('now'));
            $book->setImage(null);

            $manager->persist($book);
        }
        $manager->flush();
    }
}