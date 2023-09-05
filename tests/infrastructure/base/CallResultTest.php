<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017 www.peter.com Peter Inc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-25 14:29
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byTest\infrastructure\base;


use by\infrastructure\base\CallResult;
use PHPUnit\Framework\TestCase;

class CallResultTest extends TestCase
{

    // member function

    /**
     *
     * 
     * @uses   \by\infrastructure\base\CallResult
     * @group  base
     */
    public function testToString()
    {
        $code = 1;
        $msg = 'success';
        $data = 'data';
        $obj = new CallResult($data, $msg, $code);
        $json = '{"code":1,"msg":"success","data":"data"}';
        $this->assertNotEmpty($obj);
        $this->assertJsonStringEqualsJsonString($json, $obj->__toString());
        $code = 2;
        $msg = 'success';
        $data = ['username' => 1];
        $obj = new CallResult($data, $msg, $code);
        $json = '{"code":2,"msg":"success","data":{"username":1}}';
        $this->assertNotEmpty($obj);
        $this->assertJsonStringEqualsJsonString($json, $obj->__toString());
        var_dump($obj);
    }

    // construct

    // override function __toString()

    // member variables

    // getter setter

}
