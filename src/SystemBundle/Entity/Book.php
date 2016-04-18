<?php

namespace SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Molodyko\DashboardBundle\Util\InjectImagePropertyTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="SystemBundle\Repository\BookRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Book
{
    use InjectImagePropertyTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @ORM\Column(type="datetime")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="SystemBundle\Entity\PublishingHouse", inversedBy="book")
     * @ORM\JoinColumn(name="publishing_house_id", referencedColumnName="id")
     */
    private $publishingHouse;

    #private $author;
    #private $tags;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Book
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
     *
     * @return Book
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set publishingHouse
     *
     * @param \SystemBundle\Entity\PublishingHouse $publishingHouse
     *
     * @return Book
     */
    public function setPublishingHouse(\SystemBundle\Entity\PublishingHouse $publishingHouse = null)
    {
        $this->publishingHouse = $publishingHouse;

        return $this;
    }

    /**
     * Get publishingHouse
     *
     * @return \SystemBundle\Entity\PublishingHouse
     */
    public function getPublishingHouse()
    {
        return $this->publishingHouse;
    }
}
