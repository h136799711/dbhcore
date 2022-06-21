<?php

namespace by\component\exception;


use by\infrastructure\constants\BaseErrorCode;
use JetBrains\PhpStorm\Pure;
use Throwable;

class ClientIdLimitException extends BaseException
{
    /**
     * ClientIdLimitException constructor.
     * @param string|array $message
     * @param int $code
     * @param Throwable|null $previous
     */
    #[Pure]
    public function __construct($message = 'client id limit' , $code = BaseErrorCode::Api_Request_Rate_Limit, Throwable $previous = null)
    {
        parent::__construct('', $code, $previous);
        $this->message = $message;
    }

}
