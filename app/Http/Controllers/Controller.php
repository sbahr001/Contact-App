<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function errorResponse($errors=[], $statusCode = 400)
    {
        $displayMessage = $errors;

        if (is_array($errors)) {
            $displayMessage = implode(' | ', $errors);
        }

        if ($errors instanceof MessageBag) {
            $displayMessage = implode(' | ', $errors->all());
        }

        return response()->json([
            'success' => false,
            'errors' => [
                'display_message' => $displayMessage,
            ]
        ], $statusCode);
    }
}
