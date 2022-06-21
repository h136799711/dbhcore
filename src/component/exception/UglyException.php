<?php
/**
 * Created by PhpStorm.
 * User: itboye
 * Date: 2018/8/9
 * Time: 17:44
 */

namespace by\component\exception;


use by\infrastructure\constants\BaseErrorCode;
use JetBrains\PhpStorm\Pure;
use Throwable;

class UglyException extends BaseException
{
    #[Pure]
    public function __construct($message = "未知异常", $code = BaseErrorCode::Api_EXCEPTION, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
