<?php
namespace Src\Controllers;

use Src\Services\Reports\TurnoverReportService;
use Src\Controllers\Controller;
/**
 * retrieve Turnover Report Details
 */
class TurnoverReportController extends Controller{

   
   /**
     * User Turnover Report Service.
     * 
     * @var Turnover Reports
    */
    private $turnoverReportService;
    
    
    
    /**
     * 
     * @param  $userService User service.
     */
    public function __construct() {
        $this->turnoverReportService = new TurnoverReportService();
        $this->tax=getenv('TAX_VAT');
    }

    /**
     * Invoke.
     * 
     * @param ServerRequestInterface $request Request.
     * @return void
     */
    public function __invoke($request) {
      
        $result=null;
      
        if (empty($request['type'])){
            return $this->notFoundResponse();
        }
        $request['tax']=$this->tax; 
        switch($request['type']){
            case  'brand':
                $result =  $this->turnoverReportService->getTurnoverBrandReport($request);break;
            case  'daily':
                $result =  $this->turnoverReportService->getTurnoverDailyReport($request);

          }
        if (empty($result))
            return $this->unprocessableEntityResponse('Requested method is invalid.');

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;

    }


}