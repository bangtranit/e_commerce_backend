<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait{
    public function apiException($request, Exception $e){
        if ($this->isModel($e)){
            return $this->modelResponse();
        }
        if ($this->isHttp($e)){
            return $this->httpResponse();
        }
    }

    public function isModel(Exception $e){
        return $e instanceof NotFoundHttpException;
    }

    public function isHttp(Exception $e){
        return $e instanceof ModelNotFoundException;
    }

    public function modelResponse(){
        return response()->json([
            'errors' => 'Incorrect Route'
        ], Response::HTTP_NOT_FOUND);
    }

    public function httpResponse(){
        return response()->json([
            'errors' => 'Model Not Found'
        ], Response::HTTP_NOT_FOUND);
    }
}