<?php

namespace App\Traits\Responses;

trait HttpResponseTrait
{

    public function success($message,$data,$statusCode=200)
    {
        return [
            'message'   => $message,
            'data'      => $data,
            'status'    => $statusCode,
        ];
    }
}