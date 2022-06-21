<?php

namespace by\component\exception;



use by\infrastructure\constants\BaseErrorCode;
use JetBrains\PhpStorm\Pure;

class NotLoginException extends BaseException
{
    #[Pure]
    public function __construct($message = "会话失效,请重新登", $code = BaseErrorCode::Api_Need_Login, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
