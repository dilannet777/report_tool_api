<?php
namespace Src\Repositories;

use Src\Models\Brand;
use Src\Models\Gmv;
use Src\Mappers\Pdo\PdoBrandMapper;
use Src\Mappers\Pdo\PdoMapper;

/**
 * User collection.
 */
class BrandRepository {

    /**
     * User mapper (a data mapper).
     * 
     * @var BrandMapperInterface
     */
    private $brandMapper;

    /**
     * 
     * @param BrandMapper $brandMapper Brand mapper.
     */
    public function __construct() {
        $this->brandMapper = new PdoBrandMapper();
    }

    /**
     * Find a brand by id.
     * 
     * @param int $id Brand id.
     * @return Brand Brand.
     */
    public function findBrandById(int $id) {
        return $this->brandMapper->fetchBrandById($id);
    }

    /**
     * Find all brands.
     * 
     * @return Brand[] Brand list.
     */
    public function findAllBrands() {
        return $this->brandMapper->fetchAllBrands();
    }

    /**
     * Store a brand.
     * 
     * @param Brand $brand Brand.
     * @return Brand Brand.
     */
    public function storeBrand(Brand $brand) {
        return $this->brandMapper->saveBrand($brand);
    }
    
    /**
     * Check if the given brand exists.
     * 
     * @param Brand $brand Brand.
     * @return bool True if brand exists, false otherwise.
     */
    public function brandExists(Brand $brand) {
        return $this->brandMapper->brandExists($brand);
    }

    /**
     * return turnover report against the brands.
     * 
     * @param $reqeust.
     * @return array $array.
     */
    public function getTurnoverBrandReport($request)
    {
        $queryObj=new PdoMapper();
        
        return  $queryObj->table('brands')
        ->select("brands.name,date(max(gmv.date)) as week_end_date, round(sum(gmv.turnover - (gmv.turnover * $request[tax])),2) AS turnover")
        ->join('join','gmv','gmv.brand_id','brands.id')
        ->groupBy("WEEK(gmv.date),brands.name")
        ->orderBy('WEEK(gmv.date)')
        ->query();

    }

 }