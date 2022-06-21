<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 2018/12/20
 * Time: 17:13
 */

namespace by\infrastructure\helper;


class OSHelper
{
    /**
     * 系统位数判断
     * @return int
     */
    public static function systemBit(): int
    {
        $int = "9223372036854775807";
        $int = intval($int);
        if ($int == 9223372036854775807) {
            return 64;
        }
        elseif ($int == 2147483647) {
            return 32;
        }
        else {
            return -1;
        }
    }
}
