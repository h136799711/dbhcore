<?php

namespace by\component\exception;


use by\infrastructure\constants\BaseErrorCode;
use JetBrains\PhpStorm\Pure;
use Throwable;

class RateLimitResponseException extends BaseException
{
    #[Pure]
    public function __construct($message = '请求频繁' , $code = BaseErrorCode::Api_Request_Rate_Limit, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
