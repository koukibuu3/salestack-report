<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Sale;

use InvalidArgumentException;

/**
 * 商品価格
 */
final class ItemPrice
{
    /** @var int 値 */
    public readonly int $value;

    /**
     * @throws InvalidArgumentException 値が不正な場合
     */
    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException('itemPrice must be greater than or equal to 0.');
        }

        if ($value % 50 !== 0) {
            throw new InvalidArgumentException('itemPrice must be a multiple of 50.');
        }

        $this->value = $value;
    }
}
