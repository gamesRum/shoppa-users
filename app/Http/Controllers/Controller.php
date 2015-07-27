<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function getJSON($code, $status, $message='', $data=null, $count=0) {
        $response = [
            'status' => $status,
            'data' => $data,
            'count' => $count,
            'message' => $message
        ];

        return $response;
    }
}
