<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ForbiddenException extends AbstractException
{
    /**
     * AuthenticationException constructor.
     *
     * @param mixed $exception
     */
    public function __construct($exception = '')
    {
        $code = Response::HTTP_FORBIDDEN;
        parent::__construct($exception, $code);
    }
}
