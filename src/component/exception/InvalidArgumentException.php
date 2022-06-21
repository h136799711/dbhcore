<?php
/**
 * Created by PhpStorm.
 * User: itboye
 * Date: 2018/8/7
 * Time: 18:32
 */

namespace by\component\exception;

use by\infrastructure\constants\BaseErrorCode;
use JetBrains\PhpStorm\Pure;

class InvalidArgumentException extends BaseException
{
    /**
     * ClientIdLimitException constructor.
     * @param string|array $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    #[Pure]
    public function __construct($message , $code = BaseErrorCode::Invalid_Parameter, \Throwable $previous = null)
    {
        parent::__construct('', $code, $previous);
        $this->message = $message;
    }
}
