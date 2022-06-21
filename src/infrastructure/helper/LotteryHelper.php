<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
// | ©2018 California State Lottery All rights reserved.
// +----------------------------------------------------------------------
// | Author: Smith Jack
// +----------------------------------------------------------------------

namespace by\infrastructure\helper;

/**
 * Class LotteryHelper
 *
 * @package by\infrastructure\helper
 */
class LotteryHelper
{
    /**
     * 获取一个奖项
     * 格式 , 所有中奖概率之和必须小于 $maxProp
     * 奖项编号推荐为奖品的唯一id
     * ['奖项编号'=>中奖概率, '奖项编号'=>中奖概率]
     * @param array $allPrize
     * @param int $maxProp
     * @return int 小于0 则错误，可以视作不中奖，其它情况返回奖项编号
     */
    public static function randPrize(array $allPrize, int $maxProp = 1000): int
    {
        $allProp = 0;
        $randPrizeItem = [];
        foreach ($allPrize as $k => $v) {
            $allProp += $v;
            if ($allProp > $maxProp) {
                return -2;
            }
            if ($v <= 0) {
                // 中奖概率小于等于0 则不计入
                continue;
            }
            array_push($randPrizeItem, [
                'n' => $k,
                'p' => $v
            ]);
        }

        if ($allProp < $maxProp) {
            array_push($randPrizeItem, [
                'n' => -3,
                'p' => $maxProp - $allProp
            ]);
        }

        shuffle($randPrizeItem);

        $prizeNum = rand(0, $maxProp);
        $num = 0;
        foreach ($randPrizeItem as $item) {
            if ($prizeNum >= $num && $prizeNum < $num + $item['p']) {
                return substr($item['n'], 1, strlen($item['n']) - 1);
            }
            $num += $item['p'];
        }
        return -1;
    }
}
