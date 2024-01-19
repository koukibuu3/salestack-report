<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\Entities;

use App\Domain\Invoice\Entities\SaleCollection;
use App\Domain\Invoice\Entities\Sale;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group entities
 * @group saleCollection
 */
final class SaleCollectionTest extends TestCase
{
    private readonly SaleCollection $reportSaleCollection;

    private readonly array $expectedReportSales;

    public function setUp(): void
    {
        parent::setUp();

        $this->expectedReportSales = [
            new Sale('2023-08-13', 'テスト商品', 1000, 10.5, 'テストメモ', 10500, 840),
            new Sale('2023-08-13', 'テスト商品2', 1000, 10.5, 'テストメモ', 10500, 840),
            new Sale('2023-08-14', 'テスト商品3', 2000, 20.5, 'テストメモ2', 41000, 3280),
        ];

        $this->reportSaleCollection = new SaleCollection($this->expectedReportSales);
    }

    /** @test */
    public function 売上の合計件数が取得できる(): void
    {
        $this->assertSame(3, $this->reportSaleCollection->count);
    }

    /** @test */
    public function 売上の合計金額_税抜が取得できる(): void
    {
        $this->assertEquals(62000, $this->reportSaleCollection->totalAmount);
    }

    /** @test */
    public function 売上の合計税額が取得できる(): void
    {
        $this->assertEquals(4960, $this->reportSaleCollection->totalTax);
    }

    /** @test */
    public function 売上の合計金額_税込が取得できる(): void
    {
        $this->assertEquals(66960, $this->reportSaleCollection->totalAmountWithTax);
    }
}
