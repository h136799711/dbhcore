<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017 www.peter.com Peter Inc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-25 11:26
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byTest\infrastructure\helper;

use by\infrastructure\helper\Object2DataArrayHelper;
use PHPUnit\Framework\TestCase;

class BaseJsonObjectTest extends TestCase
{

    // member function
    private $id;
    private $id2;
    private $id3;
    private $id4;
    private $id5;
    private $id6;
    private $id7;
    private $id8;
    private $id9;
    private $id10;
    private $id11;
    private $id12;
    private $id13;
    private $id14;
    private $id15;
    private $toUpper;
    private $toLower;
    private $null;
    /**
     * test
     * @var  ?\byTest\infrastructure\helper\TestEntity
     */
    private ?TestEntity $entity = null;
    /**
     * test
     * @var  ?\byTest\infrastructure\helper\TestEntity
     */
    private ?TestEntity $entity2 = null;
    /**
     * test
     * @var  ?\byTest\infrastructure\helper\TestEntity
     */
    private ?TestEntity $entity3 = null;





    /**
     * @covers BaseJsonObject
     * @uses   \by\infrastructure\helper\Object2DataArrayHelper
     * @group  helper
     * @group  array_helper
     */
    public function testJsonObject()
    {
//        return;
        $test = new BaseJsonObjectTest("empty");
//        var_dump(Object2DataArrayHelper::getDataArrayFrom($test));
//        exit;
        Object2DataArrayHelper::setData($test, ['id' => '11', 'to_lower' => 'lower', 'to_upper' => 'upper', 'null' => null, 'name' => 'set test entity']);
        var_dump($test->getEntity());
        $array = Object2DataArrayHelper::getDataArrayFrom($test, ['id', 'to_upper']);
        $this->assertArrayNotHasKey('to_lower', $array);
        $this->assertArrayHasKey('to_upper', $array);
        $this->assertArrayHasKey('id', $array);
        $array = Object2DataArrayHelper::getDataArrayFrom($test);
        var_dump($array);
        $this->assertArrayNotHasKey('null', $array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('to_upper', $array);
        $this->assertArrayNotHasKey('toUpper', $array);
        $array = Object2DataArrayHelper::getDataArrayFrom($test, ['id', 'toUpper', 'to_upper']);
        $this->assertArrayNotHasKey('lower', $array);
        $this->assertArrayNotHasKey('toUpper', $array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('to_upper', $array);

        $this->assertEquals('upper', $array['to_upper']);
        $this->assertEquals('11', $array['id']);
        $array = Object2DataArrayHelper::getDataArrayFrom($test, [], false);
        $this->assertArrayHasKey('null', $array);
        $this->assertNull($array['null']);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('to_upper', $array);
        $this->assertArrayNotHasKey('toUpper', $array);
    }



    public function testMountJsonObject()
    {
        $testsCnt = 5;
        $testResult = [];
        $avgTime = 0;
        $maxTime = 0;
        $minTime = 999;
        Object2DataArrayHelper::$cacheReflectionCls = [];
        // 对超过15以上属性的类进行10000次设置
        for ($jj = 0; $jj < $testsCnt; $jj++) {
            $list = [];
            for ($i = 0; $i < 10000; $i++) {
                array_push($list, new BaseJsonObjectTest("test".$i));
            }
            $now = microtime(true);
            $len = count($list);
            for ($j = 0; $j < $len; $j++) {
                Object2DataArrayHelper::setData($list[$j],
                    [
                        'id' => $j,
                        'id2' => $j,
                        'id3' => $j,
                        'id4' => $j,
                        'id5' => $j,
                        'id6' => $j,
                        'id7' => $j,
                        'id8' => $j,
                        'id9' => $j,
                        'id10' => $j,
                        'id11' => $j,
                        'id12' => $j,
                        'id13' => $j,
                        'id14' => $j,
                        'id15' => $j,
                        'to_lower' => 'lower',
                        'to_upper' => 'upper',
                        'null' => null,
                        'name' => $j . 'set test entity'
                    ]);
            }
            $costTime = microtime(true) - $now;
//            echo "\n",'cost time = '. $costTime,"\n";
            array_push($testResult, $costTime);
            if ($costTime > $maxTime) {
                $maxTime = $costTime;
            }
            if ($costTime < $minTime) {
                $minTime = $costTime;
            }

        }

        for ($kj = 0; $kj < $testsCnt; $kj++) {
            $avgTime += ($testResult[$kj]);
        }
        $avgTime = $avgTime / $testsCnt;
        echo "avg time" . $avgTime, "\n";
        echo "max time" . $maxTime, "\n";
        echo "min time" . $minTime, "\n";
        $this->assertCount(1, Object2DataArrayHelper::$cacheReflectionCls);
        // var_dump(Object2DataArrayHelper::$cacheEntityProperty);
        // var_dump(Object2DataArrayHelper::$cacheClassProperty);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId2()
    {
        return $this->id2;
    }

    /**
     * @param mixed $id2
     */
    public function setId2($id2): void
    {
        $this->id2 = $id2;
    }

    /**
     * @return mixed
     */
    public function getId3()
    {
        return $this->id3;
    }

    /**
     * @param mixed $id3
     */
    public function setId3($id3): void
    {
        $this->id3 = $id3;
    }

    /**
     * @return mixed
     */
    public function getId4()
    {
        return $this->id4;
    }

    /**
     * @param mixed $id4
     */
    public function setId4($id4): void
    {
        $this->id4 = $id4;
    }

    /**
     * @return mixed
     */
    public function getId5()
    {
        return $this->id5;
    }

    /**
     * @param mixed $id5
     */
    public function setId5($id5): void
    {
        $this->id5 = $id5;
    }

    /**
     * @return mixed
     */
    public function getId6()
    {
        return $this->id6;
    }

    /**
     * @param mixed $id6
     */
    public function setId6($id6): void
    {
        $this->id6 = $id6;
    }

    /**
     * @return mixed
     */
    public function getId7()
    {
        return $this->id7;
    }

    /**
     * @param mixed $id7
     */
    public function setId7($id7): void
    {
        $this->id7 = $id7;
    }

    /**
     * @return mixed
     */
    public function getId8()
    {
        return $this->id8;
    }

    /**
     * @param mixed $id8
     */
    public function setId8($id8): void
    {
        $this->id8 = $id8;
    }

    /**
     * @return mixed
     */
    public function getId9()
    {
        return $this->id9;
    }

    /**
     * @param mixed $id9
     */
    public function setId9($id9): void
    {
        $this->id9 = $id9;
    }

    /**
     * @return mixed
     */
    public function getId10()
    {
        return $this->id10;
    }

    /**
     * @param mixed $id10
     */
    public function setId10($id10): void
    {
        $this->id10 = $id10;
    }

    /**
     * @return mixed
     */
    public function getId11()
    {
        return $this->id11;
    }

    /**
     * @param mixed $id11
     */
    public function setId11($id11): void
    {
        $this->id11 = $id11;
    }

    /**
     * @return mixed
     */
    public function getId12()
    {
        return $this->id12;
    }

    /**
     * @param mixed $id12
     */
    public function setId12($id12): void
    {
        $this->id12 = $id12;
    }

    /**
     * @return mixed
     */
    public function getId13()
    {
        return $this->id13;
    }

    /**
     * @param mixed $id13
     */
    public function setId13($id13): void
    {
        $this->id13 = $id13;
    }

    /**
     * @return mixed
     */
    public function getId14()
    {
        return $this->id14;
    }

    /**
     * @param mixed $id14
     */
    public function setId14($id14): void
    {
        $this->id14 = $id14;
    }

    /**
     * @return mixed
     */
    public function getId15()
    {
        return $this->id15;
    }

    /**
     * @param mixed $id15
     */
    public function setId15($id15): void
    {
        $this->id15 = $id15;
    }

    /**
     * @return mixed
     */
    public function getToUpper()
    {
        return $this->toUpper;
    }

    /**
     * @param mixed $toUpper
     */
    public function setToUpper($toUpper): void
    {
        $this->toUpper = $toUpper;
    }

    /**
     * @return mixed
     */
    public function getToLower()
    {
        return $this->toLower;
    }

    /**
     * @param mixed $toLower
     */
    public function setToLower($toLower): void
    {
        $this->toLower = $toLower;
    }

    /**
     * @return mixed
     */
    public function getNull()
    {
        return $this->null;
    }

    /**
     * @param mixed $null
     */
    public function setNull($null): void
    {
        $this->null = $null;
    }

    /**
     * @return ?TestEntity
     */
    public function getEntity(): ?TestEntity
    {
        return $this->entity;
    }

    /**
     * @param TestEntity $entity
     */
    public function setEntity(TestEntity $entity): void
    {
        $this->entity = $entity;
    }

    /**
     * @return ?TestEntity
     */
    public function getEntity2(): ?TestEntity
    {
        return $this->entity2;
    }

    /**
     * @param TestEntity $entity2
     */
    public function setEntity2(TestEntity $entity2): void
    {
        $this->entity2 = $entity2;
    }

    /**
     * @return ?TestEntity
     */
    public function getEntity3(): ?TestEntity
    {
        return $this->entity3;
    }

    /**
     * @param TestEntity $entity3
     */
    public function setEntity3(TestEntity $entity3): void
    {
        $this->entity3 = $entity3;
    }

}
