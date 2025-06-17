<?php

namespace App\Exceptions;

use Exception;

class DynamicFetchUnAuth extends Exception
{
    public function __construct($message = 'unauthenticated', $code = 403)
    {
        parent::__construct($message, $code);
    }

    public function render($request)
    {
        return response()->json([
            'success' => false,
            'error' => true,
            'message' => $this->getMessage()
        ], $this->getCode());
    }
}
