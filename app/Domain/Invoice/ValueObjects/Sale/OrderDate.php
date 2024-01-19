<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Sale;

use InvalidArgumentException;

/**
 * 注文日時
 */
class OrderDate
{
    /** @var string 値 ex.) '2023-08-27' */
    public readonly string $value;

    /**
     * @throws InvalidArgumentException 値が不正な場合
     */
    public function __construct(string $value, string $format = 'Y-m-d')
    {
        if (empty($value)) {
            throw new InvalidArgumentException('orderDate is empty.');
        }
        $timestamp = strtotime($value);
        if (!$timestamp) {
            throw new InvalidArgumentException('orderDate is invalid.');
        }

        $this->value = date($format, $timestamp);
    }

    /**
     * 注文日時をフォーマット
     */
    public function format(string $format): self
    {
        return new self($this->value, $format);
    }
}
