<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CustomUploadException extends Exception
{
    /**
     * Constructor method.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code = 422)
    {
        parent::__construct($message, $code);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $this->getMessage(),
            'code' => 422,
        ], 422);
    }
}
