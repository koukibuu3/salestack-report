<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Report;

use InvalidArgumentException;

/**
 * 顧客名
 */
final class CustomerName
{
    private const MAX_LENGTH = 20;

    /** @var string 値 */
    public readonly string $value;

    /**
     * @throws InvalidArgumentException 顧客名が空の場合
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('customerName is empty.');
        }
        if (mb_strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException(
                'customerName length id expected ' . self::MAX_LENGTH . ', but ' . mb_strlen($value) . '.'
            );
        }

        $this->value = $value;
    }
}
