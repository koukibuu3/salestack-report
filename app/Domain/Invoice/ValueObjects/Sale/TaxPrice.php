<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Sale;

use InvalidArgumentException;

/**
 * 税額
 */
final class TaxPrice
{
    /** @var int 値 */
    public readonly int $value;

    /**
     * @throws InvalidArgumentException 値が不正な場合
     */
    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException('taxPrice must be greater than or equal to 0.');
        }

        $this->value = $value;
    }
}
