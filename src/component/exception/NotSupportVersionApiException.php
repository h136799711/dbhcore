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

class NotSupportVersionApiException extends BaseException
{
    #[Pure]
    public function __construct($message = "不支持该版本接口,请升级至最新版本", $code = BaseErrorCode::Api_Need_Update, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
