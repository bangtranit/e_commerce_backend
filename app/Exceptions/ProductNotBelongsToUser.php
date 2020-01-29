<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToUser extends Exception
{
    public function render(){
        return response()->json([
            'code' => 401,
            'status' => 'error',
            'message' => "This product not belong",
            'data' => 'sample data'
        ]);

    }
}
