<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-27 15:16
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\constants;

/**
 * Class StatusEnum
 * 数据状态枚举
 * @package by\infrastructure\constants
 */
class StatusEnum
{
    /**
     * 已软删除数据
     */
    const SOFT_DELETE = -1;

    /**
     * 正常使用中
     */
    const ENABLE = 1;

    /**
     * 被禁用数据
     */
    const DISABLED = 0;

    public static function getDesc($status): string
    {
        return match ($status) {
            StatusEnum::DISABLED => "已禁用",
            StatusEnum::ENABLE => "启用",
            StatusEnum::SOFT_DELETE => "已删除",
            default => "未知",
        };
    }
}
