<?php

namespace by\infrastructure\helper;

class ByEncryptA100Helper
{

    /**
     * 加密方法
     * @param string $data 要加密的字符串
     * @param string $key 加密密钥
     * @param int $expire 过期时间 (单位:秒)
     * @return string
     */
    public static function encrypt($data, $key, $expire = 0)
    {
        $key = md5($key);
        $data = base64_encode($data);
        $x = 0;
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        $str = sprintf('%010d', $expire ? $expire + time() : 0);
        for ($i = 0; $i < $len; $i++) {
            $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
        }
        $str = base64_encode($str);
        $str = str_replace([
            '=',
            '+',
            '/'
        ], [
            'O0O0O',
            'o000o',
            'oo00o'
        ], $str);
        return $str;
    }

    /** * 解密方法
     * @param string $data 要解密的字符串
     * @param string $key 加密密钥
     * @param bool $ignoreExpire 忽略时间
     * @return string|bool bool|string Returns the decoded data or `false` on failure. The returned data may be binary
     */
    public static function decrypt($data, $key, $ignoreExpire = true)
    {
        $data = str_replace([
            'O0O0O',
            'o000o',
            'oo00o'
        ], [
            '=',
            '+',
            '/'
        ], $data);

        $key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $expire = substr($data, 0, 10);
        $data = substr($data, 10);
        if ($ignoreExpire && $expire > 0 && $expire < time()) {
            return false;
        }
        $len = strlen($data);
        $l = strlen($key);
        $char = $str = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            } else {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return base64_decode($str);
    }
}
