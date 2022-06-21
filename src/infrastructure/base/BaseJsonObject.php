<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-25 11:20
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\base;


use by\infrastructure\helper\Object2DataArrayHelper;
use by\infrastructure\interfaces\ToJsonStringInterfaces;

abstract class BaseJsonObject extends BaseObject implements ToJsonStringInterfaces
{

    // member function
    public function __toString()
    {
        return $this->toJsonString();
    }

    // override function __toString()

    function toJsonString(): bool|string
    {
        $data = Object2DataArrayHelper::getDataArrayFrom($this);
        // 注意中文编码后问题
        // JSON_UNESCAPED_UNICODE
        return json_encode($data);
    }

    // member variables

    // getter setter

}
