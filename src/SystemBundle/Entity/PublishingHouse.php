<?php

namespace SystemBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Molodyko\DashboardBundle\Util\InjectImagePropertyTrait;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="publishing_house")
 * @ORM\Entity(repositoryClass="SystemBundle\Repository\PublishingHouseRepository")
 * @ORM\HasLifecycleCallbacks
 */
class PublishingHouse
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
     * @ORM\OneToMany(targetEntity="SystemBundle\Entity\Book", mappedBy="publishingHouse")
     */
    private $book;

    public function __construct()
    {
        $this->book = new ArrayCollection();
    }

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
     * @return PublishingHouse
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
     * @return PublishingHouse
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
     * @return PublishingHouse
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
     * @return PublishingHouse
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
     * Add book
     *
     * @param \SystemBundle\Entity\Book $book
     *
     * @return PublishingHouse
     */
    public function addBook(\SystemBundle\Entity\Book $book)
    {
        $this->book->add($book);

        return $this;
    }

    /**
     * Remove book
     *
     * @param \SystemBundle\Entity\Book $book
     */
    public function removeBook(\SystemBundle\Entity\Book $book)
    {
        $this->book->removeElement($book);
    }

    /**
     * Get book
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBook()
    {
        return $this->book;
    }
}
