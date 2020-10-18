<?php

declare(strict_types=1);

namespace App\Criteria;

use App\Domain\ValueObject\Id\Id;

/**
 * 検索条件抽象クラス
 */
abstract class Criteria
{
    /**
     * ID
     *
     * @var Id
     */
    protected Id $id;

    /**
     * 件数
     *
     * @var string
     */
    protected string $limit;

    /**
     * 順序
     *
     * @var string
     */
    protected string $order;
}
