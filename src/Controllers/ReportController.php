<?php
namespace Src\Controllers;

use Src\Repositories\ReportRepository;

class ReportController {

    private $db;
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
            case  'day':
                $result = $this->reportRepository->getDayReport($request);break;

          }
        if (empty($result)) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;

    }

    public function processRequest()
    {
       
      
       
        switch ($this->requestMethod) {
            case 'GET':
                
          
                break;
            case 'POST':
                if ($this->method=='turnover') {
                    $this->input['tax']=$this->tax;
                    $response = $this->getTurnOverReport($this->input);

                } else{


                }
                break;
            case 'PUT':
                //
                break;
            case 'DELETE':
                //
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}