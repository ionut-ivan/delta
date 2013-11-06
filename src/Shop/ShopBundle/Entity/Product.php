<?php

namespace Shop\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="Shop\ShopBundle\Entity\Repository\ProductRepository")
 * @ORM\Table(name="products")
 * @ORM\HasLifecycleCallbacks()
 */
class Product {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category_id;

    /**
     * @ORM\Column(type="decimal")
     */
    private $price;

    /**
     * @ORM\Column(type="integer",length=11)
     */
    private $author_id;

    /**
     * @ORM\Column(type="string")
     */
    private $isbn;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $appearance_year;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $short_description;

    /**
     * @ORM\Column(type="integer", length =11)
     */
    private $stock;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    private $active;

    /**
     * @ORM\Column(type="string")
     */
    private $path;

    /**
     * @ORM\Column(type="string")
     */
    private $filename;
    private $quantity;
    private $temp;
    private $file;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Product
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set category_id
     *
     * @param integer $categoryId
     * @return Product
     */
    public function setCategoryId($categoryId) {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return integer 
     */
    public function getCategoryId() {
        return $this->category_id;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set author_id
     *
     * @param integer $authorId
     * @return Product
     */
    public function setAuthorId($authorId) {
        $this->author_id = $authorId;

        return $this;
    }

    /**
     * Get author_id
     *
     * @return integer 
     */
    public function getAuthorId() {
        return $this->author_id;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     * @return Product
     */
    public function setIsbn($isbn) {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string 
     */
    public function getIsbn() {
        return $this->isbn;
    }

    /**
     * Set appearance_year
     *
     * @param integer $appearanceYear
     * @return Product
     */
    public function setAppearanceYear($appearanceYear) {
        $this->appearance_year = $appearanceYear;

        return $this;
    }

    /**
     * Get appearance_year
     *
     * @return integer 
     */
    public function getAppearanceYear() {
        return $this->appearance_year;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set short_description
     *
     * @param string $shortDescription
     * @return Product
     */
    public function setShortDescription($shortDescription) {
        $this->short_description = $shortDescription;

        return $this;
    }

    /**
     * Get short_description
     *
     * @return string 
     */
    public function getShortDescription() {
        return $this->short_description;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return Product
     */
    public function setStock($stock) {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock() {
        return $this->stock;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return Product
     */
    public function setActive($active) {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive() {
        return $this->active;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Product
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return Product
     */
    public function setFilename($filename) {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename() {
        return $this->filename;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Product
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity() {
        return $this->quantity;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata) {
//        $metadata->addPropertyConstraint('quantity', new Assert\Type(array('type' => 'integer', 'message' => 'the value {{value}} is not a number')));
//        $metadata->addPropertyConstraint('quantity', new Assert\GreaterThan(array('value' => 0, 'message' => 'cannot order a negative value')));
//        $metadata->addPropertyConstraint('title', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('short_description', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('price', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('description', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('stock', new Assert\NotBlank());
//        $metadata->addPropertyConstraint('short_description', new Assert\LessThanOrEqual(array('value' => 50, 'message' => 'too long, 50 char. max')));
//        $metadata->addPropertyConstraint('short_description', new Assert\LessThanOrEqual(array('value' => 500, 'message' => 'too long, 500 char. max')));
//        $metadata->addPropertyConstraint('filename', new Assert\File(array(
//            'maxSize' => '2M',
//            'mimeTypes' => array(
//                'image/jpg',
//                'image/jpeg',
//                'image/gif',
//            ),
//            'mimeTypesMessage' => 'Please upload a valid JPG or GIF',
//        )));
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    public function getFile() {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename . '.' . $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }
    
     protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/home/iivan/Sites/delta/web/'.$this->getUploadDir();
    }
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'bundles/shopshop/image';
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

}