<?php
namespace Src\Services\Reports;

use Src\Repositories\BrandRepository;
use Src\Repositories\GmvRepository;
use Exception;

/**
 * Service for handling the reports.
 */
class TurnoverReportService {

    /**
     * Brand repository.
     * 
     * @var brandRepository
     */
    private $brandRepository;

    /**
     * Gmv repository.
     * 
     * @var gvmRepository
     */
    private $gmvRepository;

    /**
     * 
     * @param UserCollection $userCollection User collection.
     */
    public function __construct() {
        $this->brandRepository = new BrandRepository();
        $this->gmvRepository = new GmvRepository();
    }

     /**
     * Find a brand turnover details.
     * 
     * @param array $request .
     * @return array Report details.
     */
    public function getTurnoverBrandReport($request){

        $header =[
            "Header"=> "Report - 7 Days Turnover Per Brand",
            "columns"=>[
              [
                "Header"=> "Name",
                "accessor"=> "name"
              ],
              [
                "Header"=> "Week End Date",
                "accessor"=> "week_end_date"
              ],
              [
                "Header"=> "Turnover (EURO)",
                "accessor"=> "turnover"
              ]
            ]
            ];

        try {
           
            return ["columns"=>$header,"body"=>$this->brandRepository->getTurnoverBrandReport($request) ];
        } catch (Exception $e) {
            return ($e->getMessage());
        }

      

    }

     /**
     * Find a daily turnover details.
     * 
     * @param array $request .
     * @return array Report details.
     */

    public function getTurnoverDailyReport($request){

        $header =[
            "Header"=> "Report - 7 Days Turnover Per Day",
            "columns"=>[

              [
                "Header"=> "Week End Date",
                "accessor"=> "week_end_date"
              ],
              [
                "Header"=> "Turnover (EURO)",
                "accessor"=> "turnover"
              ]
            ]
            ];
            try {
                return ["columns"=>$header,"body"=>$this->gmvRepository->getTurnoverDailyReport($request) ];
            } catch (Exception $e) {
                return ($e->getMessage());
            }
  
    }

}
