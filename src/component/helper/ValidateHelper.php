<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016-10-17
 * Time: 11:09
 */

namespace by\component\helper;


use by\infrastructure\base\CallResult;
use by\infrastructure\helper\CallResultHelper;

/**
 * 校验辅助
 */
class ValidateHelper
{

    /**
     * 判断 是 0 或 1 返回 true 其它情况 false
     * @param $digit
     * @return bool
     */
    public static function isZeroOrOne($digit): bool
    {
        if (strlen($digit) > 0) {
            $digit = intval($digit);
            return $digit === 0 || $digit === 1;
        }
        return false;
    }

    /**
     * 判断是否为数字
     * @param $str
     * @return bool
     */
    public static function isNumberStr($str): bool
    {
        return !is_resource($str) && !is_array($str) && !is_object($str) && (is_int($str) || is_numeric($str) || preg_match('/^\d*$/', $str));
    }

    /**
     * 判断是否为合法的密码
     * @author peter<chendaguo@mail.com>
     * @param $password
     * @return CallResult
     */
    public static function legalPwd($password): CallResult
    {
        if (strlen($password) < 6 || strlen($password) > 64) {
            return CallResultHelper::fail('password length must between 6-64');
        }
        if (!preg_match("/^[0-9a-zA-Z\\\\,.?><;:!@#$%^&*()_+-=\[\]\{\}\|]{6,64}$/", $password)) {
            return CallResultHelper::fail('password is illegal');
        }
        return CallResultHelper::success();
    }

    /**
     * 判定是否为一个合法的11位字符串
     * @author peter<chendaguo@mail.com>
     * @param $str
     * @return bool
     */
    public static function isMobile($str): bool
    {
        if (is_string($str) && preg_match("/^1\d{10}$/", $str)) {
            return true;
        }
        if (is_string($str) && strlen($str) > 1) {
            $ch = substr($str, 0, 1);
            if (intval($ch) > 0) {
                // 第一位是数字就算是手机号登录
                return true;
            }
        }

        return false;
    }

    /**
     * 验证是否合法的结果,含数组
     * @param $result array
     * @return bool
     *@author peter<chendaguo@mail.com>
     */
    public static function legalArrayResult(array $result): bool
    {

        if (isset($result['info']) && isset($result['status']) && $result['status'] && is_array($result['info']) && count($result['info']) > 0) {
            return true;
        }

        return false;
    }

    /**
     * 判断是否为邮箱
     * 支持中文前缀，子域名邮箱
     * @param $email
     * @return bool
     */
    public static function isEmail($email): bool
    {
        $pattern = "/^[A-Za-z0-9\\x{4e00}-\\x{9fa5}]+@[a-zA-Z0-9_-]+(\\.[a-zA-Z0-9_-]+)+$/iu";
        if (is_string($email) && preg_match($pattern, $email)) {
            return true;
        }

        return false;
    }
}
