<?php

namespace Tests\Reports;


use Src\Controllers\TurnoverReportController;
use PHPUnit\Framework\TestCase;


class ReportTest extends TestCase
{
    // tested getTurnOverReport()
    public function testReportTypeIsEmpty()
    {
     
        $invokeReportTurnover = new turnoverReportController();
        $response =$invokeReportTurnover([]);
        $this->assertSame($response, ['status_code_header' => 'HTTP/1.1 404 Not Found', 'body' => null]);
    }

    // tested getTurnOverReport()
   public function testReportTypeIsNotExist()
    {
        $invokeReportTurnover = new turnoverReportController();
        $response =$invokeReportTurnover(["type" => "brnad"]);
        $this->assertSame($response, ['status_code_header' => 'HTTP/1.1 422 Unprocessable Entity', 'body' => '{"error":"Requested method is invalid."}']);
    }


}
