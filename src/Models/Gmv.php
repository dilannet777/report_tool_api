<?php

namespace Src\Models;

/**
 * Gmv.
 */
class Gmv
{

    /**
     * Id.
     * 
     * @var int
     */
    private $id;

    /**
     * Brand Id.
     * 
     * @var int
     */
    private $brandId;

    /**
     * Brand Turnover Date.
     * 
     * @var turnoverDate;
     */
    private $turnoverDate;

    /**
     * Turnover.
     * 
     * @var float
    */
    private $turnover;



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
     * Get brandId.
     * 
     * @return int
     */
    public function getBrandId()
    {
        return $this->brandId;
    }


    /**
     * Set brandId.
     * 
     * @param int $brandId  brandId.
     * @return $this
     */
    public function setBrandId(int $brandId)
    {
        $this->brandId = $brandId;
        return $this;
    }




    /**
     * Get turnoverDate.
     * 
     * @return string
     */
    public function getTurnoverDate()
    {
        return $this->turnoverDate;
    }


    /**
     * Set turnoverDate.
     * 
     * @param string $turnoverDate Turnover Date.
     * @return $this
     */
    public function setTurnoverDate(string $turnoverDate)
    {
        $this->turnoverDate = $turnoverDate;
        return $this;
    }


    /** Get Turnover.
     * 
     * @return float
     */
    public function getTurnover()
    {
        return $this->turnover;
    }


     /**
     * Set Turnover
     * 
     * @param float $turnover Turnover
     * @return $this
     */
    public function setTurnover(float $turnover)
    {
        $this->turnover = $turnover;
        return $this;
    }

 
}
