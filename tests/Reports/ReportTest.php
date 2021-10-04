<?php

namespace Tests\Reports;


use Src\Controllers\ReportController;
use PHPUnit\Framework\TestCase;


class ReportTest extends TestCase
{
    // tested getTurnOverReport()
    public function testReportTypeIsEmpty()
    {
        $controller = new ReportController(null, 'GET', 'turnover');
        $response = $controller->getTurnOverReport([]);
        $this->assertSame($response, ['status_code_header' => 'HTTP/1.1 404 Not Found', 'body' => null]);
    }

    // tested getTurnOverReport()
   public function testReportTypeIsNotExist()
    {
        $controller = new ReportController(null, 'GET', 'turnover');
        $response = $controller->getTurnOverReport(["type" => "brnad"]);
        $this->assertSame($response, ['status_code_header' => 'HTTP/1.1 422 Unprocessable Entity', 'body' => '{"error":"Requested method is invalid."}']);
    }


}
