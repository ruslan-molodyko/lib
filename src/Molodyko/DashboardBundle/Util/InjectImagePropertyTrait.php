<?php
/**
 * Created by PhpStorm.
 * User: ruslan-molodyko
 * Date: 08.04.2016
 * Time: 0:21
 */

namespace Molodyko\DashboardBundle\Util;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Inject image property with upload logic into the doctrine entity
 *
 * @package Molodyko\DashboardBundle\Util
 */
trait InjectImagePropertyTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $imageFile;

    /**
     * Temp path for saving old path of image
     *
     * @var string
     */
    private $_tempPropertyImageTrait;

    /**
     * Get image
     *
     * @return UploadedFile
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Get image path
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image path
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Sets image file
     *
     * @param UploadedFile $image
     */
    public function setImageFile(UploadedFile $image = null)
    {
        $this->imageFile = $image;
        // check if we have an old image path
        if (isset($this->image)) {
            // store the old name to delete after the update
            $this->_tempPropertyImageTrait = $this->image;
            $this->image = null;
        } else {
            $this->image = $this->getInitialImageName();
        }
    }

    /**
     * Set name of image
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploadImage()
    {
        if (null !== $this->getImageFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->image = $filename . '.' . $this->getImageFile()->guessExtension();
        }
    }

    /**
     * Upload the file
     *
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadImage()
    {
        if (null === $this->getImageFile()) {
            return;
        }

        // if there is an error when moving the image, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getImageFile()->move($this->getUploadRootDir(), $this->image);

        // check if we have an old image
        if (isset($this->_tempPropertyImageTrait)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->_tempPropertyImageTrait);
            // clear the _tempPropertyImageTrait image imageFile
            $this->_tempPropertyImageTrait = null;
        }
        $this->imageFile = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUploadImage()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    /**
     * Get absolute path to image
     *
     * @return null|string
     */
    public function getAbsolutePath()
    {
        return null === $this->image
            ? null
            : $this->getUploadRootDir() . '/' . $this->image;
    }

    /**
     * Get relative path to image
     *
     * @return null|string
     */
    public function getWebPath()
    {
        return null === $this->image
            ? null
            : $this->getUploadImageDir() . '/' . $this->image;
    }

    /**
     * The absolute directory path where uploaded
     * documents should be saved
     *
     * @return string
     */
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../www/' . $this->getUploadImageDir();
    }

    /**
     * Upload dir
     * Path which displaying uploaded doc/image in the view
     *
     * @return string
     */
    public function getUploadImageDir()
    {
        return 'uploads/images';
    }

    /**
     * Get initial image
     *
     * @return string
     */
    public function getInitialImageName()
    {
        return 'init.png';
    }
}