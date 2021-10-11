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






   
   
    /* private $db;
    private $requestMethod;
    private $method;
    private $input;
    private $tax;
 

    private $reportRepository;

    public function __construct($db, $requestMethod,$method)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->tax=getenv('TAX_VAT');
        $this->method = $method;
        $this->reportRepository = new ReportRepository($db);
        $this->input = (array) json_decode(file_get_contents('php://input'), TRUE);
    }

    public function getTurnOverReport($request){
   
        if (empty($request['type'])){
            return $this->notFoundResponse();
        }
        $result=null;
  

        switch($request['type']){
            case  'brand':  
                $result = $this->reportRepository->getBrandReport($request);break;
            case  'daily':
                $result = $this->reportRepository->getDailyReport($request);break;

          }
        if (empty($result)) {
           // $response['status_code_header'] = 'HTTP/1.1 200 OK';
           // $response['body'] = json_encode($result);

      //  }else {
           return $this->unprocessableEntityResponse('Requested method is invalid.');
        
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;

    }

    public function processRequest()
    {
     
        switch ($this->requestMethod) {
            case 'GET':
                // GET APIs
          
                break;
            case 'POST':
                // POST APIs
                if ($this->method=='turnover') {
                    $this->input['tax']=$this->tax;
                    $response = $this->getTurnOverReport($this->input);

                } else{
                    //another method

                }
                break;
            case 'PUT':
                 // PUT APIs
                break;
            case 'DELETE':
                 // DELETE APIs
            }

   

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function unprocessableEntityResponse($message="")
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => $message
        ]);
        return $response;
    }

    private function notFoundResponse()
    {  
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
    */
}