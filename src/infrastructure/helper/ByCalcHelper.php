<?php

namespace by\infrastructure\helper;

use JetBrains\PhpStorm\Pure;

/**
 * 计算辅助类
 */
class ByCalcHelper
{

    /**
     * 安全的除法 $a / $b 并返回百分比 就是乘100 ，保留2位小数点
     * @param $a
     * @param $b
     * @param int $decimals
     * @return string
     */
    #[Pure]
    public static function safeDivideFormatPercent($a, $b, int $decimals = 2): string
    {
        return self::numberFormat(100 * self::safeDivide($a, $b), $decimals);
    }

    /**
     *
     * @param $number
     * @param int $decimals
     * @param string $decimal_separator
     * @param string $thousands_separator
     * @return string
     */
    public static function numberFormat($number, int $decimals = 2, string $decimal_separator = '.', string $thousands_separator = ''): string
    {
        return number_format($number, $decimals, $decimal_separator, $thousands_separator);
    }

    /**
     * 安全的除法
     * @param float $a
     * @param float $b
     * @return float|int
     */
    public static function safeDivide(float $a, float $b): float|int
    {
        if ($b == 0) return 0;
        return $a / $b;
    }

    /**
     * @param float $a
     * @param float $b
     * @param int $decimals
     * @param float $max
     * @return string|int|float
     */
    #[Pure]
    public static function safeDivideFormatPercentNoGreaterThan(float $a,float $b, int $decimals = 2, float $max = 100): string|int|float
    {
        $num = self::numberFormat(100 * self::safeDivide($a, $b), $decimals);
        if ($num > $max) return $max;
        return $num;
    }

    /**
     * 获取周日0点
     * @param $timestamp
     * @return bool|int
     */
    public static function getSunday($timestamp): bool|int
    {
        $w = strftime('%u', $timestamp);//获取是周几的数字1-7
        return strtotime(date('Y-m-d 23:59:59', $timestamp + (7 - $w) * 24 * 60 * 60));
    }

    /**
     * 判断url文件是否存在
     * @param $url
     * @param array $headers
     * @return bool
     */
    public static function isRemoteFileExists($url, array $headers = []): bool
    {
        if (empty($headers)) {
            $headers = @current(get_headers($url));
        }
        return (bool)preg_match('~HTTP/1\.\d\s+200\s+OK~', $headers);
    }

    /**
     * @param int $page
     * @param int $size
     * @return int
     */
    #[Pure]
    public static function offset(int $page, int $size): int
    {
        return intval(self::getZeroIfNegative($page - 1)) * $size;
    }

    /**
     * 如果负数或非数值则返回0
     * @param $num
     * @return float|int|string
     */
    public static function getZeroIfNegative($num): float|int|string
    {
        if (!is_numeric($num)) return 0;
        if ($num < 0) return 0;
        return $num;
    }
}
