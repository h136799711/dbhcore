<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-24 17:01
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\base;


abstract class BaseCallResult
{

    private string|int $code;
    private string|array $msg;// 返回的结果码
    private mixed $data;//  返回消息

    public function __construct(mixed $data = '', string|array $msg = '', string|int $code = 0)
    {
        $this->code = $code;
        $this->data = $data;
        $this->msg = $msg;
    }

    /**
     * @return int|string
     */
    public function getCode(): int|string
    {
        return $this->code;
    }

    /**
     * @param int|string $code
     */
    public function setCode(int|string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string|array
     */
    public function getMsg(): string|array
    {
        return $this->msg;
    }

    /**
     * @param string|array $msg
     */
    public function setMsg(string|array $msg): void
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData(mixed $data): void
    {
        $this->data = $data;
    }
}
