<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-25 14:27
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\base;


use by\infrastructure\constants\BaseErrorCode;
use by\infrastructure\helper\Object2DataArrayHelper;
use JetBrains\PhpStorm\Pure;

class CallResult extends BaseCallResult
{
    #[Pure]
    public function __construct($data = '', $msg = '', $code = BaseErrorCode::Success)
    {
        parent::__construct($data, $msg, $code);
    }

    /**
     * 是否操作失败
     * @return bool
     */
    #[Pure]
    public function isFail(): bool
    {
        return !$this->isSuccess();
    }

    // construct

    /**
     * 是否成功
     * @return bool
     */
    #[Pure]
    public function isSuccess(): bool
    {
        return intval($this->getCode()) === BaseErrorCode::Success;
    }

    /**
     * @throws \ReflectionException
     */
    public function __toString()
    {
        // 注意中文编码后问题
        // JSON_UNESCAPED_UNICODE
        return json_encode(Object2DataArrayHelper::getDataArrayFrom($this));
    }

}
