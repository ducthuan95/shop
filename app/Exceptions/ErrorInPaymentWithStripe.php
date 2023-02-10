<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ErrorInPaymentWithStripe extends AbstractException
{
    /**
     * ServerErrorException constructor.
     *
     * @param mixed $exception
     */
    public function __construct($exception = '')
    {
        $code = Response::HTTP_SERVICE_UNAVAILABLE;
        parent::__construct($exception, $code);
    }
}
