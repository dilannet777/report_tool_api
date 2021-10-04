<?php

namespace Tests\Reports;


use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;


class ReportAPITest extends TestCase
{
    
    protected $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => getenv('TEST_API_URL'),
            'exceptions' => false
        ]);
    }

    // tested getTurnOverReport()

    public function testTurnoverDailyReport()
    {
        
        
        $response = $this->client->request('POST','/api/reports/turnover',[
            'headers' => [ 'Accept' => 'application/json'],
            'json'=>['type' => 'daily']]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testTurnoverBrandReport()
    {
        
        $response = $this->client->request('POST','/api/reports/turnover',[
            'headers' => [ 'Accept' => 'application/json'],
            'json'=>['type' => 'brand']]);

        $this->assertEquals(200, $response->getStatusCode());
    }


}
