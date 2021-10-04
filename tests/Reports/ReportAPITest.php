<?php

namespace Tests\Reports;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;


class ReportAPITest extends TestCase
{
    
    protected $client;
    // tested getTurnOverReport()

    public function testTurnoverDailyReport()
    {
        
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8000',
            'exceptions' => false
        ]);
        $response = $this->client->request('POST','/api/reports/turnover',[
            'headers' => [ 'Accept' => 'application/json'],
            'json'=>['type' => 'daily']]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testTurnoverBrandReport()
    {
        
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8000',
            'exceptions' => false
        ]);
        $response = $this->client->request('POST','/api/reports/turnover',[
            'headers' => [ 'Accept' => 'application/json'],
            'json'=>['type' => 'brand']]);

        $this->assertEquals(200, $response->getStatusCode());
    }


}
