<?php
/**
 * Created by PhpStorm.
 * User: itboye
 * Date: 2018/8/7
 * Time: 17:13
 */

namespace by\component\exception;


use by\infrastructure\constants\BaseErrorCode;
use JetBrains\PhpStorm\Pure;
use Throwable;

class NoParamException extends BaseException
{
    #[Pure]
    public function __construct($message = "", $code = BaseErrorCode::Lack_Parameter, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
