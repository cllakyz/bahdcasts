<?php

namespace App\Exceptions;

use Exception;

class AuthFailedException extends Exception
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'message' => 'These credentials do not match our records.'
        ], 422);
    }
}