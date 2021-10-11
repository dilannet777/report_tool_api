<?php

namespace Src\Models;

/**
 * Brand.
 */
class Brand
{

    /**
     * Id.
     * 
     * @var int
     */
    private $id;

    /**
     * Brand Name.
     * 
     * @var string
     */
    private $brandName;

    /**
     * Brand Deacription.
     * 
     * @var string
     */
    private $description;

    /**
     * Brand Created Date.
     * 
     * @var datetime
     */
    private $createdDate;

    /**
     * Number of Products.
     * 
     * @var int
     */
    private $products;

    /**
     * Get id.
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set id.
     * 
     * @param int $id Id.
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * Get brandName.
     * 
     * @return string
     */
    public function getBrandName()
    {
        return $this->name;
    }


    /**
     * Set name.
     * 
     * @param string $name Name.
     * @return $this
     */
    public function setBrandName(string $brandName)
    {
        $this->$brandName = $brandName;
        return $this;
    }



    /**
     * Get Created Date.
     * 
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }


     /**
     * Set Created Date.
     * 
     * @param string $created Created Date.
     * @return $this
     */
    public function setCreatedDate(string $createdDate)
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * Get description.
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->name;
    }

     /**
     * Set Descriptions.
     * 
     * @param string $description description
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }


    /** Get Product Sales Count.
     * 
     * @return int
     */
    public function getProductCount()
    {
        return $this->products;
    }


     /**
     * Set Product Sales Count
     * 
     * @param int $product Product Count
     * @return $this
     */
    public function setProductCount(int $products)
    {
        $this->products = $products;
        return $this;
    }

 
}
