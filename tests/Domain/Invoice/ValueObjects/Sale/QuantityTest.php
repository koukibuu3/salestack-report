<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Sale;

use App\Domain\Invoice\ValueObjects\Sale\Quantity;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group sale
 * @group quantity
 */
final class QuantityTest extends TestCase
{
    private Quantity $quantity;

    public function setUp(): void
    {
        parent::setUp();

        $this->quantity = new Quantity(10.5);
    }

    /** @test */
    public function 数量を取得できる(): void
    {
        $this->assertSame(10.5, $this->quantity->value);
    }

    /** @test */
    public function 数量が0未満の場合は例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('quantity must be greater than or equal to 0.');

        new Quantity(-1);
    }
}
