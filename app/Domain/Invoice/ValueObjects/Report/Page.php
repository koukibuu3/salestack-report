<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Report;

use App\Domain\Invoice\Entities\Sale;
use InvalidArgumentException;

/**
 * 請求書ページ
 */
final class Page
{
    public const MAX_ROWS = 10;

    /** 売上件数 */
    public readonly int $salesCount;

    /** 売上合計金額 */
    public readonly int $salesAmount;

    /**
     * @param int $pageNo
     * @param Sale[] $sales
     * @throws InvalidArgumentException
     */
    public function __construct(
        public readonly int $pageNo,
        public readonly array $sales
    ) {
        if (count($sales) > self::MAX_ROWS) {
            throw new InvalidArgumentException('Sale rows must be less than or equal to ' . self::MAX_ROWS);
        }

        $this->salesCount = count($sales);
        $this->salesAmount = array_reduce(
            $sales,
            fn (int $c, Sale $sale) => $c + $sale->amount->value,
            0
        );
    }
}
