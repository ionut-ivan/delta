<?php

namespace Shop\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Shop\ShopBundle\Entity\Repository\CartItemsRepository")
 * @ORM\Table(name="cart_items")
 * @ORM\HasLifecycleCallbacks()
 */
class CartItems {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cart")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
    protected $cart_id;

    /**
     * @ORM\OneToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product_id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    protected $quantity;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $price;

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
     * @return Cart_items
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
     * Set quantity
     *
     * @param integer $quantity
     * @return Cart_items
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

    /**
     * Set price
     *
     * @param float $price
     * @return Cart_items
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
     * Set cart_id
     *
     * @param \Shop\ShopBundle\Entity\Cart $cartId
     * @return Cart_items
     */
    public function setCartId(\Shop\ShopBundle\Entity\Cart $cartId = null) {
        $this->cart_id = $cartId;

        return $this;
    }

    /**
     * Get cart_id
     *
     * @return \Shop\ShopBundle\Entity\Cart 
     */
    public function getCartId() {
        return $this->cart_id;
    }

    /**
     * Set product_id
     *
     * @param \Shop\ShopBundle\Entity\Product $cartid
     * @return Cart_items
     */
    public function setProductId(\Shop\ShopBundle\Entity\Product $productId = null) {
        $this->product_id = $productId;

        return $this;
    }

    /**
     * Get product_id
     *
     * @return \Shop\ShopBundle\Entity\Product 
     */
    public function getProductId() {
        return $this->product_id;
    }

    public function __toString() {
        return $this->getProductId();
    }

}