<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Sale;

use InvalidArgumentException;

/**
 * 商品名
 */
final class ItemName
{
    /** 商品名の最大長 */
    private const MAX_LENGTH = 20;

    /** @var string 値 */
    public readonly string $value;

    /**
     * @throws InvalidArgumentException 値が不正な場合
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('itemName is empty.');
        }
        if (mb_strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException(
                'itemName length id expected ' . self::MAX_LENGTH . ', but ' . mb_strlen($value) . '.'
            );
        }

        $this->value = $value;
    }
}
