<?php

namespace SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="publishing_house")
 * @ORM\Entity(repositoryClass="SystemBundle\Repository\PublishingHouseRepository")
 */
class PublishingHouse
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $image;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $isbn;

    /**
     * @ORM\Column(type="date")
     */
    private $year;

    private $publishingHouse;
    private $author;
    private $tags;
}
