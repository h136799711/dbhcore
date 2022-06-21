<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-12-15 17:05
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\interfaces;


use by\infrastructure\base\CallResult;

interface CheckInterfaces
{
    /**
     * @return CallResult
     */
    function check(): CallResult;
}
