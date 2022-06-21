<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-20 11:29
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\paging\vo;


use by\infrastructure\base\BaseObject;
use by\infrastructure\helper\ByCalcHelper;
use by\infrastructure\helper\Object2DataArrayHelper;
use by\infrastructure\interfaces\ObjectToArrayInterface;
use JetBrains\PhpStorm\Pure;

class PagingParams extends BaseObject implements ObjectToArrayInterface
{

    private int $pageIndex;
    private int $pageSize;

    // construct
    public function __construct(int $pageIndex = 0,int $pageSize = 10)
    {
        parent::__construct();
        $this->setPageIndex($pageIndex);
        $this->setPageSize($pageSize);
    }

    /**
     * 偏移量 如果pageIndex是1 则返回0，2 则是 pageSize ,3则是 2*pageSize
     * @return int
     */
    #[Pure]
    public function offset(): int
    {
        $pageIndex = $this->getPageIndex() - 1;
        $pageIndex = $pageIndex < 0 ? 0 : $pageIndex;
        return $pageIndex * $this->getPageSize();
    }

    /**
     * @return int
     */
    public function getPageIndex(): int
    {
        return $this->pageIndex;
    }

    /**
     * 保证大于等于0
     * @param int $pageIndex
     */
    public function setPageIndex(int $pageIndex)
    {
        // 保证大于等于0
        $this->pageIndex = ByCalcHelper::getZeroIfNegative($pageIndex);
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * 值 大于 1
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize)
    {
        // 保证大于等于1
        $this->pageSize = ($pageSize < 1 ? 1 : $pageSize);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        return Object2DataArrayHelper::getDataArrayFrom($this);
    }
}
