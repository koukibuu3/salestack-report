<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Report;

use PHPUnit\Framework\TestCase;
use App\Domain\Invoice\Entities\Sale;
use App\Domain\Invoice\ValueObjects\Report\Page;
use App\Domain\invoice\ValueObjects\Report\PageCollection;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group report
 * @group pageCollection
 */
class PageCollectionTest extends TestCase
{
    /**
     * デフォルトの売上配列
     */
    private readonly array $defaultRequestSaleParameter;

    public function setUp(): void
    {
        parent::setUp();

        $this->defaultRequestSaleParameter = [
            'orderDate' => '2024-01-06',
            'itemName' => 'item',
            'itemPrice' => 100,
            'quantity' => 1,
            'memo' => 'memo',
            'amount' => 100,
            'taxPrice' => 10,
        ];
    }

    /** @test */
    public function ページが取得できる(): void
    {
        $pages = [
            new Page(1, []),
        ];

        $collection = new PageCollection($pages);
        $this->assertSame($pages, $collection->pages);
    }

    /** @test */
    public function 売上件数が取得できる(): void
    {
        $pages = [
            new Page(1, [
                new Sale(...$this->defaultRequestSaleParameter),
                new Sale(...$this->defaultRequestSaleParameter),
            ]),
            new Page(2, [
                new Sale(...$this->defaultRequestSaleParameter),
            ]),
        ];

        $collection = new PageCollection($pages);
        $this->assertSame(3, $collection->getSalesCount());
    }

    /** @test */
    public function ページ数が取得できる(): void
    {
        $pages = [
            new Page(1, [
                new Sale(...$this->defaultRequestSaleParameter),
                new Sale(...$this->defaultRequestSaleParameter),
            ]),
            new Page(2, [
                new Sale(...$this->defaultRequestSaleParameter),
            ]),
        ];

        $collection = new PageCollection($pages);
        $this->assertSame(2, $collection->getPagesCount());
    }

    /** @test */
    public function 売上金額が取得できる(): void
    {
        $pages = [
            new Page(1, [
                new Sale(...[...$this->defaultRequestSaleParameter, 'amount' => 100]),
                new Sale(...[...$this->defaultRequestSaleParameter, 'amount' => 200]),
            ]),
            new Page(2, [
                new Sale(...[...$this->defaultRequestSaleParameter, 'amount' => 500]),
            ]),
        ];

        $collection = new PageCollection($pages);
        $this->assertSame(800, $collection->getSalesAmount());
    }
}
