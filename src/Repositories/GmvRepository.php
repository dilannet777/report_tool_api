<?php
namespace Src\Repositories;

use Src\Models\Gmv;
use Src\Mappers\GmvMapperInterface;
use Src\Mappers\Pdo\PdoMapper;

/**
 * User collection.
 */
class GmvRepository {

    /**
     * User mapper (a data mapper).
     * 
     * @var GmvMapperInterface
     */
    private $GmvMapper;

    /**
     * 
     * @param GmvMapper $gmvMapper Gmv mapper.
     */
    public function __construct() {
       // $this->gmvMapper = $gmvMapper;
    }

    /**
     * Find a gmv by id.
     * 
     * @param int $id Gmv id.
     * @return Gmv Gmv.
     */
    public function findGmvById(int $id) {
        return $this->gmvMapper->fetchGmvById($id);
    }

    /**
     * Find all gmvs.
     * 
     * @return Gmv[] Gmv list.
     */
    public function findAllGmvs() {
        return $this->gmvMapper->fetchAllGmvs();
    }

    /**
     * Store a gmv.
     * 
     * @param Gmv $gmv Gmv.
     * @return Gmv Gmv.
     */
    public function storeGmv(Gmv $gmv) {
        return $this->gmvMapper->saveGmv($gmv);
    }
    
    /**
     * Check if the given gmv exists.
     * 
     * @param Gmv $gmv gmv.
     * @return bool True if gmv exists, false otherwise.
     */
    public function gmvExists(Gmv $gmv) {
        return $this->gmvMapper->gmvExists($gmv);
    }

    /**
     * return turnover report against the days.
     * 
     * @param $reqeust.
     * @return array $array.
     */
    public function getTurnoverDailyReport($request)
    {
        $queryObj=new PdoMapper();
        
        return  $queryObj->table('gmv')
        ->select("date(max(date)) as week_end_date, round(sum(turnover - (turnover * $request[tax]))/7,2) as turnover")
        ->groupBy("WEEK(date)")
        ->orderBy("WEEK(date)")
        ->query();

    }
 
 }