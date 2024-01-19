<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Report;

use App\Domain\Invoice\ValueObjects\Report\ToDate;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group report
 * @group toDate
 */
final class ToDateTest extends TestCase
{
    private ToDate $toDate;

    public function setUp(): void
    {
        parent::setUp();

        $this->toDate = new ToDate('2023/08/27');
    }

    /** @test */
    public function 終了日時が取得できる(): void
    {
        $this->assertSame('2023-08-27', $this->toDate->value);
    }

    /** @test */
    public function 終了日時が空の場合は例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('toDate is empty.');

        new ToDate('');
    }

    /** @test */
    public function 終了日時が不正な値の場合は例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('toDate is invalid.');

        new ToDate('2023/08/32');
    }
}
