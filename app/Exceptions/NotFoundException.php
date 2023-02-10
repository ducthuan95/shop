<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class NotFoundException extends AbstractException
{
    /**
     * NotFoundException constructor.
     *
     * @param mixed $exception
     */
    public function __construct($exception = '')
    {
        $code = Response::HTTP_NOT_FOUND;
        parent::__construct($exception, $code);
    }
}
