<?php


namespace by\infrastructure\helper;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class TimeHelper
{
    const ShowAll = 31;

    const ShowSeconds = 1;

    const ShowMinute = 2;

    const ShowHour = 4;

    const ShowDay = 8;

    const ShowYear = 16;

    public static function formatString($seconds, $show = self::ShowAll, $lang = 'zh'): string
    {
        $format = self::format($seconds, $show);
        $str = '';
        if ($lang == 'zh') {
            if ($format['year'] > 0) {
                $str .= $format['year'] . '年';
            }
            if ($format['day'] > 0) {
                $str .= $format['day'] . '天';
            }
            if ($format['hour'] > 0) {
                $str .= $format['hour'] . '小时';
            }
            if ($format['min'] > 0) {
                $str .= $format['min'] . '分';
            }
            if ($format['sec'] > 0) {
                $str .= $format['sec'] . '秒';
            }

            if (empty($str)) {
                $str = '0秒';
            }
            return $str;
        } else {

            if ($format['year'] > 0) {
                $str .= $format['year'] . 'y';
            }
            if ($format['day'] > 0) {
                $str .= $format['day'] . 'd';
            }
            if ($format['hour'] > 0) {
                $str .= $format['hour'] . 'h';
            }
            if ($format['min'] > 0) {
                $str .= $format['min'] . 'm';
            }
            if ($format['sec'] > 0) {
                $str .= $format['sec'] . 's';
            }

            if (empty($str)) {
                $str = '0s';
            }
            return $str;
        }
    }

    #[ArrayShape(['sec'  => "int",
                  'min'  => "int",
                  'hour' => "int",
                  'day'  => "int",
                  'year' => "float|int"
    ])] public static function format($seconds, $show = self::ShowAll): array
    {
        $format = ['sec' => 0, 'min' => 0, 'hour' => 0, 'day' => 0, 'year' => 0];

        if (self::ShowSeconds === ($show & self::ShowSeconds)) {
            // 显示秒
            $format['sec'] = ($seconds % 60);
        }
        if (self::ShowMinute === ($show & self::ShowMinute)) {
            // 显示分钟
            $format['min'] = (floor($seconds / 60) % 60);
        }
        if (self::ShowHour === ($show & self::ShowHour)) {
            // 显示天
            $format['hour'] = (floor($seconds / 3600) % 24);
        }
        if (self::ShowDay === ($show & self::ShowDay)) {
            // 显示天
            $format['day'] = (floor($seconds / 24 / 3600) % 365);
        }
        if (self::ShowYear === ($show & self::ShowYear)) {
            // 显示天
            $format['year'] = floor($seconds / 3600 / 365);
        }
        return $format;
    }

    /**
     * 今日0点时间戳
     * @return false|int
     */
    public static function todayTime(): bool|int
    {
        return strtotime(date("Y-m-d 0:0:0"));
    }

    /**
     * 今天 0点的 日期格式
     * @param string $format 日期格式默认 Ymd
     * @return bool|string
     */
    #[Pure] public static function today(string $format = 'Ymd'): bool|string
    {
        return date($format, self::todayTime());
    }

    /**
     * 本月1日0点时间戳
     * @return false|int
     */
    public static function thisMonthZeroHour(): bool|int
    {
        return strtotime(date("Y-m-01 0:0:0"));
    }
}
