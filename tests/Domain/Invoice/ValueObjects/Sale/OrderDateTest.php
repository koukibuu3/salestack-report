<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Sale;

use App\Domain\Invoice\ValueObjects\Sale\OrderDate;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group sale
 * @group orderDate
 */
final class OrderDateTest extends TestCase
{
    private OrderDate $orderDate;

    public function setUp(): void
    {
        parent::setUp();

        $this->orderDate = new OrderDate('2023-08-13');
    }

    /** @test */
    public function 注文日時が取得できる(): void
    {
        $this->assertSame('2023-08-13', $this->orderDate->value);
    }

    /** @test */
    public function 注文日時が指定したフォーマットで取得できる(): void
    {
        $this->assertSame('08 13', $this->orderDate->format('m d')->value);
    }

    /** @test */
    public function 注文日時が日付として不正な場合は例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('orderDate is invalid.');

        new OrderDate('invalid date');
    }

    /** @test */
    public function 注文日時が空の場合は例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('orderDate is empty.');

        new OrderDate('');
    }
}
