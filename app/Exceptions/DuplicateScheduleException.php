<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class DuplicateScheduleException extends AbstractException
{
    /**
     * ServerErrorException constructor.
     *
     * @param mixed $exception
     */
    public function __construct($exception = '')
    {
        $code = Response::HTTP_BAD_REQUEST;
        
        parent::__construct($exception, $code);
    }
}
