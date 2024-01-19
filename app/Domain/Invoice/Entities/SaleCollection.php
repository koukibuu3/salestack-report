<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Entities;

use App\Domain\Invoice\Entities\Sale;
use Illuminate\Support\Collection;

/**
 * 売上コレクション
 */
class SaleCollection
{
    /** @var Sale[] ソートされた売上の配列 */
    public readonly array $sortedSales;

    /** @var int 売上の合計件数 */
    public readonly int $count;

    /** @var int 売上の合計金額(税抜) */
    public readonly int $totalAmount;

    /** @var int 売上の合計税額 */
    public readonly int $totalTax;

    /** @var int 売上の合計金額(税込) */
    public readonly int $totalAmountWithTax;

    /**
     * @param Sale[] $sales
     */
    public function __construct(array $sales)
    {
        $this->sortedSales = Collection::make($sales)
            ->sortBy(fn (Sale $sale) => $sale->orderDate->value)
            ->values()
            ->toArray();
        // usort($this->sortedSales, fn (Sale $a, Sale $b) => $a->orderDate->value <=> $b->orderDate->value);

        $this->count = count($sales);

        $totalAmount = 0;
        $totalTax = 0;
        $totalAmountWithTax = 0;
        foreach ($sales as $sale) {
            $totalAmount += $sale->amount->value;
            $totalTax += $sale->taxPrice->value;
            $totalAmountWithTax += $sale->amount->value + $sale->taxPrice->value;
        }

        $this->totalAmount = $totalAmount;
        $this->totalTax = $totalTax;
        $this->totalAmountWithTax = $totalAmountWithTax;
    }
}
