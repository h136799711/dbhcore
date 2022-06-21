<?php

namespace by\infrastructure\helper;


/**
 * 速率统计，基于内存统计，所以必须是常驻内存才能统计的
 * 可以统计指定秒内的平均速率 比如 30秒内平均接收多少个消息
 * Class RateStaticsHelper
 * @package ss\common\business
 */
class RateStaticsHelper
{

    public int $seconds = 31;
    public array $passedSecondsRate = [];// $seconds - 1秒内接收到的消息数量
    public int $avgRate = 0; // $seconds - 1秒内的平均消息数量

    public function record($now, $count = 1)
    {
        if (count($this->passedSecondsRate) != $this->seconds) {
            for ($i = 0; $i < $this->seconds; $i++) {
                $this->passedSecondsRate[$i] = [$now - $i, 0];
            }
        }
        $tmp = [];
        for ($i = 0; $i < $this->seconds; $i++) {
            $tmp[$i] = [$now - $i, 0];
            for ($j = 0; $j < $this->seconds; $j++) {
                if ($tmp[$i][0] === $this->passedSecondsRate[$j][0]) {
                    $tmp[$i][1] = $this->passedSecondsRate[$j][1];
                    if ($i === 0) {
                        $tmp[$i][1] += $count;
                    }
                    break;
                }
            }
        }
        $this->avgRate = 0;
        for ($j = 0; $j < $this->seconds; $j++) {
            $this->passedSecondsRate[$j][0] = $tmp[$j][0];
            $this->passedSecondsRate[$j][1] = $tmp[$j][1];
            if ($j > 0) {
                $this->avgRate += $tmp[$j][1];
            }
        }
        $this->avgRate = number_format($this->avgRate / ($this->seconds - 1), 4, ".", "");
    }
}
