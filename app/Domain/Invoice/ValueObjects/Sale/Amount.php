<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Sale;

use InvalidArgumentException;

/**
 * 売上金額
 */
class Amount
{
    /** 最大桁数 */
    private const MAX_DIGIT = 7;

    /** @var int 値 */
    public readonly int $value;

    /** @var (int|null)[] 一桁ごとに分割された値 ex.) [null, null, 1, 2, 3, 0, 0] */
    public readonly array $splittedValue;

    public function __construct(mixed $value)
    {
        if (!is_numeric($value)) { // 数値でない場合を許可しない
            throw new InvalidArgumentException('Amount must be numeric.');
        }
        if (is_float($value)) { // 整数でない場合を許可しない
            throw new InvalidArgumentException('Amount must not be float.');
        }
        if ((int) $value < 0) { // 0未満の場合を許可しない
            throw new InvalidArgumentException('Amount must be greater than or equal to 0.');
        }
        if (strlen((string) $value) > self::MAX_DIGIT) { // 最大桁数を超える場合を許可しない
            throw new InvalidArgumentException("Amount digit must be less than or equal to " . self::MAX_DIGIT . ".");
        }

        $this->value = (int) $value;

        $splitted = array_map(fn (string $n) => (int) $n, str_split((string) $value));
        $this->splittedValue = array_pad($splitted, -self::MAX_DIGIT, null); // NULL埋めした値を詰める
    }
}
