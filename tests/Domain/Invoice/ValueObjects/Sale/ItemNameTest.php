<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Sale;

use App\Domain\invoice\ValueObjects\Sale\ItemName;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group sale
 * @group itemName
 */
final class ItemNameTest extends TestCase
{
    private ItemName $customerName;

    public function setUp(): void
    {
        parent::setUp();

        $this->customerName = new ItemName('商品名');
    }

    /** @test */
    public function 商品名を取得できる(): void
    {
        $this->assertSame('商品名', $this->customerName->value);
    }

    /** @test */
    public function 商品名が空の場合は例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('itemName is empty.');

        new ItemName('');
    }

    /** @test */
    public function 商品名が20文字を超える場合は例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('itemName length id expected 20, but 21.');

        new ItemName('123456789012345678901');
    }
}
