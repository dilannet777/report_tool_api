<?php

namespace Tests\Reports;


use Mockery as m;
use Src\Controllers\ReportController;
use PHPUnit\Framework\TestCase;
use Src\Repositories\ReportRepository;

class ReportTest extends TestCase
{
    // tested getTurnOverReport()
    public function testReportTypeIsEmpty()
    {
        $controller = new ReportController(null, 'GET','turnover');
        $response=$controller->getTurnOverReport([]);
        $this->assertSame($response,['status_code_header' =>'HTTP/1.1 404 Not Found','body' =>null]);
      
   }

   // tested getTurnOverReport()
   public function testReportTypeIsNotExist()
   {
       $controller = new ReportController(null, 'GET','turnover');
       $response=$controller->getTurnOverReport(["type"=>"brnad"]);
       $this->assertSame($response,['status_code_header' =>'HTTP/1.1 404 Not Found','body' =>null]);
     
   }

   //processRequest
   public function testProccessRequestMehtodIsNull()
   {
       $controller = new ReportController(null, null,'turnover');
       $response=$controller->processRequest();
      
       $this->assertSame($response,['status_code_header' =>'HTTP/1.1 422 Unprocessable Entity','body' =>json_encode([
        'error' => 'Requested method is invalid.'
    ])]);
     
   }

   //processRequest
   public function testProccessRequestMehtodIsInvalid()
   {
       $controller = new ReportController(null, 'PSOT','turnover');
       $response=$controller->processRequest();
       $this->assertSame($response,['status_code_header' =>'HTTP/1.1 422 Unprocessable Entity','body' =>json_encode([
        'error' => 'Requested method is invalid.'
    ])]);
     
   }
}

