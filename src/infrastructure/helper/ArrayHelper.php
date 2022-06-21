<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 10:46
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\helper;

/**
 * Class ArrayHelper
 * 数组帮助类
 * @package by\infrastructure\helper
 */
class ArrayHelper
{
    private static ?ArrayHelper $instance = null;
    private string $defaultValue = '';
    private mixed $data;

    /**
     * @return ArrayHelper
     */
    public static function getInstance(): ArrayHelper
    {
        if (self::$instance == null) {
            self::$instance = new ArrayHelper();
        }
        return self::$instance;
    }

    /**
     * 过滤掉数组中的键
     * @param array $array 原数组
     * @param array $keys 需要过滤掉的键
     */
    public static function filter(array &$array, array $keys = [])
    {
        array_walk($keys, function ($vo) use (&$array) {
            unset($array[$vo]);
        });
    }

    /**
     * 从$_POST获取数据来设置到指定参数
     * @param $param
     * @param mixed $defaultValue
     * @param null $scope
     */
    public static function setValueFromPost(&$param, mixed $defaultValue = '', $scope = null)
    {
        $array = $_POST ?? [];
        self::setValue($param, $array, $defaultValue, $scope);
    }

    // member function

    /**
     * Not recommended
     * 不建议使用该函数，
     * 1. 该函数使用过多必然有一定性能损失，毕竟是遍历了get_defined_vars()数值，
     *    当然这个数组不会很大
     * 2. 只测试了部分场景php版本7测试过，其它版本没测试过，cli环境下也没测试过
     * 从数组中获取值赋值给 $param 变量 ,$param的变量名作为key值从数组中取值
     * 例子:
     * $array = ['username'=>'peter']
     * self::setValue($username, $array, 'default_value', get_defined_vars())
     * @param $param
     * @param $array
     * @param mixed $defaultValue
     * @param null $scope
     */
    public static function setValue(&$param, $array, mixed $defaultValue = '', $scope = null)
    {
        if (NULL == $scope) {
            $scope = $GLOBALS;
        }
        $param = "tmp_exists_" . mt_rand();
        $name = array_search($param, $scope, TRUE);
        $param = self::getValue($name, $array, $defaultValue);
    }

    /**
     * 从数组中根据key获取值，如果没有这个key，则返回默认值
     * @param string $key 数组键
     * @param array $array 数组
     * @param mixed|null $defaultValue 默认值
     * @return string 值
     */
    public static function getValue(string $key, array $array, mixed $defaultValue = '')
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        return $defaultValue;
    }

    public static function get_variable_name(&$var, $scope = NULL): bool|int|string
    {
        if (NULL == $scope) {
            $scope = $GLOBALS;
        }

        $tmp = $var;
        $var = "tmp_exists_" . mt_rand();
        $name = array_search($var, $scope, TRUE);
        $var = $tmp;
        return $name;
    }

    /**
     * 从数值中获取值并赋值给变量 $value
     * @param string $key 键
     * @param array $array 数组
     * @param object $value 变量
     * @return mixed 赋值后的变量
     */
    public static function getValueTo(string $key, array $array, object &$value): mixed
    {
        if (array_key_exists($key, $array)) {
            $value = $array[$key];
        }
        return $value;
    }

    /**
     * @param $data
     * @return ArrayHelper
     */
    public function from($data): ArrayHelper
    {
        $this->data = $data;
        return $this;
    }

    public function getValueBy($key, $defaultValue = '')
    {
        if ($this->data && array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return $defaultValue;
    }

    // construct

    // override function __toString()

    // member variables

    // getter setter

}
