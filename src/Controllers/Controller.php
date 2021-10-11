<?php
namespace Src\Controllers;

/**
 * retrieve Turnover Report Details
 */
abstract class Controller {


    public function __construct() {}
    
    protected function unprocessableEntityResponse($message="")
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => $message
        ]);
        return $response;
    }

    protected function notFoundResponse()
    {  
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

}