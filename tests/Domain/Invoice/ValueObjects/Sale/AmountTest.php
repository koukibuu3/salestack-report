<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Sale;

use App\Domain\Invoice\ValueObjects\Sale\Amount;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group sale
 * @group amount
 */
final class AmountTest extends TestCase
{
    private Amount $amount;

    public function setUp(): void
    {
        parent::setUp();

        $this->amount = new Amount(12300);
    }

    /** @test */
    public function 売上金額が取得できる(): void
    {
        $this->assertSame(12300, $this->amount->value);
    }

    /** @test */
    public function 売上金額が一桁ごとに分割された配列で取得できる(): void
    {
        $this->assertSame([null, null, 1, 2, 3, 0, 0], $this->amount->splittedValue);
    }

    /** @test */
    public function 売上金額が数値でない場合は例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount must be numeric.');

        new Amount('non-numeric value');
    }

    /** @test */
    public function 売上金額が0未満の場合は例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount must be greater than or equal to 0.');

        new Amount('-1');
    }

    /** @test */
    public function 売上金額が最大桁数を超える場合は例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount digit must be less than or equal to 7.');

        new Amount('12345678');
    }
}
