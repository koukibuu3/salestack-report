<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Sale;

use App\Domain\Invoice\ValueObjects\Sale\ItemPrice;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group sale
 * @group itemPrice
 */
final class ItemPriceTest extends TestCase
{
    private ItemPrice $itemPrice;

    public function setUp(): void
    {
        parent::setUp();

        $this->itemPrice = new ItemPrice(1000);
    }

    /** @test */
    public function 商品価格を取得できる(): void
    {
        $this->assertSame(1000, $this->itemPrice->value);
    }

    /** @test */
    public function 商品価格が0円以下の場合は例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('itemPrice must be greater than or equal to 0.');

        new ItemPrice(-1);
    }

    /** @test */
    public function 商品価格が50円単位でない場合は例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('itemPrice must be a multiple of 50.');

        new ItemPrice(1001);
    }
}
