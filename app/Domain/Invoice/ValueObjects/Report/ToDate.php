<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Report;

use InvalidArgumentException;

/**
 * 終了日時
 */
final class ToDate
{
    private const FORMAT = 'Y-m-d';

    /** @var string 値 ex.) '2023-08-27' */
    public readonly string $value;

    /**
     * @throws InvalidArgumentException 開始日時が不正な値の場合
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('toDate is empty.');
        }
        $timestamp = strtotime($value);
        if (!$timestamp) {
            throw new InvalidArgumentException('toDate is invalid.');
        }

        $this->value = date(self::FORMAT, $timestamp);
    }
}
