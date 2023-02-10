<?php

namespace App\Exceptions;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class AbstractException extends Exception
{
    protected $code;
    protected $message;
    protected $exception;

    /**
     * AbstractException constructor.
     *
     * @param mixed $exception
     * @param int   $code
     */
    public function __construct($exception = '', int $code = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR)
    {
        if (is_object($exception) && method_exists($exception, 'getMessage')) {
            $this->exception = $exception;
            $message         = $exception->getMessage();
        } else {
            $message = (string)$exception ?: trans("exception.{$code}");
        }

        $this->code    = $code;
        $this->message = $message ?: trans('exception.500');
        parent::__construct($message, $code);
    }

    /**
     * @param  Request      $request
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'now'         => Carbon::now()->toDateTimeString(),
            'status_code' => $this->code,
            'data'        => [],
            'message'     => $this->message
        ], $this->code);
    }

    /**
     * Log an exception.
     */
    public function report()
    {
        $skipStrings = [
            '/vendor/',
            '/public/',
            '{main}',
            '[internal function]',
        ];
        $trace = explode("\n", $this->exception);
        $trace = array_filter($trace, function ($value) use ($skipStrings) {
            $pass = true;

            foreach ($skipStrings as $skipString) {
                if (strpos($value, $skipString)) {
                    $pass = false;

                    break;
                }
            }

            return $pass;
        }, ARRAY_FILTER_USE_BOTH);

        Log::error($trace);
    }
}
