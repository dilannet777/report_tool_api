<?php

namespace Tests\Reports;


use Mockery as m;
use Src\Controllers\ReportController;
use PHPUnit\Framework\TestCase;
use Src\Repositories\ReportRepository;

class ReportTest extends TestCase
{
    public function testReportTypeIsEmpty()
    {
        $controller = new ReportController(null, 'GET','turnover');
        $response=$controller->getTurnOverReport([]);
        $this->assertSame($response,['status_code_header' =>'HTTP/1.1 404 Not Found','body' =>null]);
      
   }

   public function testReportTypeIsNotExist()
   {
       $controller = new ReportController(null, 'GET','turnover');
       $response=$controller->getTurnOverReport(["type"=>"brnad"]);
       $this->assertSame($response,['status_code_header' =>'HTTP/1.1 404 Not Found','body' =>null]);
     
  }
}

