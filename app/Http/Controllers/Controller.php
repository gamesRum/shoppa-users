<?php

namespace App\Http\Controllers;

use Validator;
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

        return response()->json($response, $code);
    }

    public function getIndex($object, $objectText){
      $response = null;

      if($object->isEmpty()) {
          $response = $this->getJSON(HTTP_NOT_FOUND, 'error', 'No '.$objectText.' found.');
      } else {
          $response = $this->getJSON(HTTP_OK, 'success', $object->count().' '.$objectText.' found.', $object, $object->count());
      }

      return $response;
    }

    public function getRead($object, $objectText, $id, $find, $mainField){
        $response = null;
        if($object = $find ){
            $response = $this->getJSON(HTTP_OK, 'success', $objectText.' found: '.$mainField, $object);
        } else {
            $response = $this->getJSON(HTTP_NOT_FOUND, 'error', $objectText.' #'.$id.' - Not found.');
        }
        return $response;
    }
}
