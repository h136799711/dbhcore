<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-12-12 14:38
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\helper;


use by\component\string_extend\helper\StringHelper;
use by\infrastructure\helper\CallResultHelper;
use by\infrastructure\helper\DocParserHelper;
use by\infrastructure\helper\LangHelper;
use by\infrastructure\helper\Object2DataArrayHelper;
use by\infrastructure\interfaces\CheckInterfaces;

class ReflectionHelper
{

    private static $required = "_required";
    private static $regex = "_match_regex";

    /**
     * 使用传入数据调用方法
     * 1. 支持 @参数名_required 注释 ，在参数值等于默认值或为null时会返回调用失败信息
     *     比如 @username_required username is required
     * 2. 2017-12-15 增加支持对实现CheckInterface的类参数进行检验
     * @param object $object 对象
     * @param string $methodName 方法名
     * @param array $data 传入参数值数据
     * @return \by\infrastructure\base\CallResult
     */
    public static function invokeWithArgs(object $object, string $methodName = 'index', array $data = []): \by\infrastructure\base\CallResult
    {
        $ref = new \ReflectionClass($object);
        try {
            $method = $ref->getMethod($methodName);
            if (!$method->isPublic()) {
                return CallResultHelper::fail(LangHelper::lang('cant access not public method'));
            }
            $params = $method->getParameters();
            $doc = $method->getDocComment();
            $docParams = DocParserHelper::parse($doc);
            $args = [];
            foreach ($params as $vo) {
                if ($vo instanceof \ReflectionParameter) {
                    $paramName = $vo->getName();
                    $cls = $vo->getType();

                    $defaultValue = $vo->isDefaultValueAvailable() ? $vo->getDefaultValue() : null;
                    $underLineParamName = StringHelper::camelCaseToUnderline($paramName);

                    if (($cls instanceof \ReflectionNamedType || $cls instanceof \ReflectionUnionType) && !$cls->isBuiltin()) {
                        $clsName = $cls->getName();
                        $value = new $clsName;
                        Object2DataArrayHelper::setData($value, $data);
                        if ($value instanceof CheckInterfaces) {
                            $checkResult = ($value->check());
                            if (!$checkResult->isSuccess()) return $checkResult;
                        }
                    } elseif (array_key_exists($underLineParamName, $data)) {
                        // 下划线形式
                        $value = $data[$underLineParamName];
                    } elseif (array_key_exists($paramName, $data)) {
                        // 原始参数名称
                        $value = $data[$paramName];
                    } else {
                        $value = $defaultValue;
                    }


                    // 正则检测
                    $key = $underLineParamName . self::$regex;
                    if (array_key_exists($key, $docParams)) {
                        $regex = $docParams[$key];
                        if (is_array($regex)) {
                            foreach ($regex as $item) {
                                $item = trim($item);
                                [$reg, $msg] = self::splitRegex($item);
                                if (!preg_match($reg, $value)) {
                                    return CallResultHelper::fail(LangHelper::lang($msg));
                                }
                            }
                        } else {
                            $regex = trim($regex);
                            [$reg, $msg] = self::splitRegex($regex);
                            if (!preg_match($reg, $value)) {
                                return CallResultHelper::fail(LangHelper::lang($msg));
                            }
                        }
                    }


                    $key = $underLineParamName . self::$required;

                    if (array_key_exists($key, $docParams) && is_null($value)) {
                        $msg = $docParams[$key];

                        return CallResultHelper::fail(LangHelper::lang($msg), $data);
                    }

                    array_push($args, $value);
                }
            }

            $result = $method->invokeArgs($object, $args);
            return $result;

        } catch (\ReflectionException $exception) {
            return CallResultHelper::fail($exception->getMessage());
        }
    }

    public static function splitRegex($str)
    {
        $regex = "/reg:(.*)msg:(.*)/i";
        $matches = [];
        preg_match($regex, $str, $matches);
        if (count($matches) == 3) {
            array_shift($matches);
        }
        return $matches;
    }

}
