<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class UnprocessableEntityException extends AbstractException
{
    /**
     * ServerErrorException constructor.
     *
     * @param mixed $exception
     */
    public function __construct($exception = '')
    {
        $code = Response::HTTP_UNPROCESSABLE_ENTITY;
        parent::__construct($exception, $code);
    }
}
