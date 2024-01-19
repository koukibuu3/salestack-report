<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Report;

use App\Domain\Invoice\ValueObjects\Report\FileName;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group report
 * @group fileName
 */
final class FileNameTest extends TestCase
{
    /** @test */
    public function ファイル名が取得できる(): void
    {
        $fileName = new FileName('売上票_顧客名_2020-01-01~2020-01-31.xlsx');
        $this->assertSame('売上票_顧客名_2020-01-01~2020-01-31.xlsx', $fileName->value);
    }

    /** @test */
    public function ファイル名に使用できない文字を取り除いたファイル名が取得できる(): void
    {
        $fileName = new FileName('売上票_顧客名/:*?"<>|_2020-01-01~2020-01-31.xlsx');
        $this->assertSame('売上票_顧客名_2020-01-01~2020-01-31.xlsx', $fileName->value);
    }
}
