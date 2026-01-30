<?php

namespace App\Traits; trait ApiResponseTrait {

    protected function response($data, $message = null, $status=null, $error=null) {
        return response()->json([
            'success' => $status >= 200 && $status < 300,
            'power' => $data,
            'message' => $message,
            'error' => $error
        ], $status);
    }
}
