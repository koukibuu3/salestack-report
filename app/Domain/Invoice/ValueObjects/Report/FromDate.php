<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Report;

use InvalidArgumentException;

/**
 * 開始日時
 */
final class FromDate
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
            throw new InvalidArgumentException('fromDate is empty.');
        }
        $timestamp = strtotime($value);
        if (!$timestamp) {
            throw new InvalidArgumentException('fromDate is invalid.');
        }

        $this->value = date(self::FORMAT, $timestamp);
    }
}
