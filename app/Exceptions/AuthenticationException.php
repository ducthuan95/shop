<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class AuthenticationException extends AbstractException
{
    /**
     * AuthorizationException constructor.
     *
     * @param mixed $exception
     */
    public function __construct($exception = '')
    {
        $code = Response::HTTP_UNAUTHORIZED;
        parent::__construct($exception, $code);
    }
}
