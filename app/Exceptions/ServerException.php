<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ServerException extends AbstractException
{
    /**
     * ServerException constructor.
     *
     * @param mixed $exception
     */
    public function __construct($exception = '')
    {
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        parent::__construct($exception, $code);
    }
}
