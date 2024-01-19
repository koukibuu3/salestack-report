<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Sale;

use InvalidArgumentException;

/**
 * 備考
 */
final class Memo
{
    private const MAX_LENGTH = 50;

    /** @var string 値 */
    public readonly string $value;

    /**
     * @throws InvalidArgumentException 備考が不正な値の場合
     */
    public function __construct(string $value)
    {
        if (mb_strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException(
                'memo length id expected ' . self::MAX_LENGTH . ', but ' . mb_strlen($value) . '.'
            );
        }

        $this->value = $value;
    }
}
