<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Sale;

use InvalidArgumentException;

/**
 * 数量
 */
final class Quantity
{
    /** @var float 値 */
    public readonly float $value;

    /**
     * @throws InvalidArgumentException 値が不正な場合
     */
    public function __construct(float $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException('quantity must be greater than or equal to 0.');
        }

        $this->value = $value;
    }
}
