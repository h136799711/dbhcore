<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017 www.peter.com Peter Inc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 11:13
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byTest\infrastructure\helper;


use by\component\helper\ReflectionHelper;
use by\infrastructure\helper\CallResultHelper;
use PHPUnit\Framework\TestCase;

class DocParserHelperTest extends TestCase
{

    // member function

    /**
     * testGEtDoc
     * @demo_required demo is required
     * @demo2_required (demo2) is required
     * @group doc_parser
     * @return \by\infrastructure\base\CallResult|void
     * @throws \ReflectionException
     */
    public function testGetDoc()
    {

        $ref = new \ReflectionClass($this);
        $method = $ref->getMethod('add');
//        $this->assertEquals('add', $method->getName());
        $doc = $method->getDocComment();
//        $params = DocParserHelper::parse($doc);
//        var_dump($params);
//        ReflectionHelper::splitRegex("reg:\d/");
//        ReflectionHelper::splitRegex("reg:\d/ msg:333 ");

//        exit;

        $result = ReflectionHelper::invokeWithArgs($this, 'add', ['demo' => '124444', 'reg_from'=>1, 'demoTest' => 12345678901, 'demo_test' => 12345671]);
        var_dump($result);
        $this->assertEquals(true, $result->isSuccess(), $result->getMsg());
        $data = $result->getData();
        $this->assertEquals(12345671, $data['demoTest']);
    }

    /**
     *
     * @reg_from_match_regex reg:/^\d{1}$/i msg:regFrom length 1 and only digit
     * @demo_test_match_regex reg:/^\d{1,10}$/i     msg:the type must be integer
     * @demo_match_regex reg:/^\w{3,6}$/i msg:the value length must in 3-6
     * @demo_required demo is required
     * @demo_test_required param demo_test is required
     * @param string $msg
     * @param string $demo
     * @param string $demoTest
     * @param string $regFrom
     * @return \by\infrastructure\base\CallResult
     */
    public function add(string $msg = '',string $demo = '', string $demoTest = '', string $regFrom = ''): \by\infrastructure\base\CallResult
    {
        return CallResultHelper::success(['demo' => $demo, 'demoTest' => $demoTest], $msg);
    }

}
