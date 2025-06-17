<?php

namespace App\Exceptions;

use Exception;

class CustomAuthorizationException extends Exception
{
    public function __construct($message = 'Bu əməliyyatı yerinə yetirmək üçün icazəniz yoxdur.', $code = 403)
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
