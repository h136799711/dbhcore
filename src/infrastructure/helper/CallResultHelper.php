<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-24 17:01
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\helper;

use by\infrastructure\base\CallResult;

/**
 * 所有调用结果的帮助
 * Class CallResultHelper
 * @package by\infrastructure
 */
class CallResultHelper
{

    public function __construct()
    {
    }

    public static function success($data = '', $msg = 'success', $code = 0): CallResult
    {
        if ($msg === 'success') $msg = LangHelper::lang($msg);
        return new CallResult($data, $msg, $code);
    }

    public static function fail($msg = 'fail', $data = '', $code = -1): CallResult
    {
        if ($msg === 'fail') $msg = LangHelper::lang($msg);
        return new CallResult($data, $msg, $code);
    }
}
