<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Entities;

use App\Domain\Invoice\ValueObjects\Sale\Amount;
use App\Domain\Invoice\ValueObjects\Sale\ItemName;
use App\Domain\Invoice\ValueObjects\Sale\ItemPrice;
use App\Domain\Invoice\ValueObjects\Sale\Memo;
use App\Domain\Invoice\ValueObjects\Sale\Quantity;
use App\Domain\Invoice\ValueObjects\Sale\TaxPrice;
use App\Domain\Invoice\ValueObjects\Sale\OrderDate;

/**
 * 売上
 */
class Sale
{
    /** @var OrderDate 注文日時 */
    public readonly OrderDate $orderDate;

    /** @var ItemName 商品名 */
    public readonly ItemName $itemName;

    /** @var ItemPrice 商品価格 */
    public readonly ItemPrice $itemPrice;

    /** @var Quantity 数量 */
    public readonly Quantity $quantity;

    /** @var Memo 備考 */
    public readonly Memo $memo;

    /** @var Amount 金額 */
    public readonly Amount $amount;

    /** @var TaxPrice 税額 */
    public readonly TaxPrice $taxPrice;

    public function __construct(
        string $orderDate,
        string $itemName,
        int $itemPrice,
        float $quantity,
        string $memo,
        int $amount,
        int $taxPrice
    ) {
        $this->orderDate = new OrderDate($orderDate);
        $this->itemName = new ItemName($itemName);
        $this->itemPrice = new ItemPrice($itemPrice);
        $this->quantity = new Quantity($quantity);
        $this->memo = new Memo($memo);
        $this->amount = new Amount($amount);
        $this->taxPrice = new TaxPrice($taxPrice);
    }
}
