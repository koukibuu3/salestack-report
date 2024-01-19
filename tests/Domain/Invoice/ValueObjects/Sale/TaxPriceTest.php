<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Sale;

use App\Domain\Invoice\ValueObjects\Sale\TaxPrice;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group sale
 * @group taxPrice
 */
final class TaxPriceTest extends TestCase
{
    private TaxPrice $taxPrice;

    public function setUp(): void
    {
        parent::setUp();

        $this->taxPrice = new TaxPrice(1100);
    }

    /** @test */
    public function 税額を取得できる(): void
    {
        $this->assertSame(1100, $this->taxPrice->value);
    }

    /** @test */
    public function 税額が0円以下の場合は例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('taxPrice must be greater than or equal to 0.');

        new TaxPrice(-1);
    }
}
