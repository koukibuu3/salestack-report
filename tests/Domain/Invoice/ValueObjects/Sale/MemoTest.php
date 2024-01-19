<?php

declare(strict_types=1);

namespace Tests\Domain\Invoice\ValueObjects\Sale;

use App\Domain\Invoice\ValueObjects\Sale\Memo;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @group domain
 * @group invoice
 * @group valueObjects
 * @group sale
 * @group memo
 */
final class MemoTest extends TestCase
{
    private Memo $memo;

    public function setUp(): void
    {
        parent::setUp();

        $this->memo = new Memo('メモ');
    }

    /** @test */
    public function メモを取得できる(): void
    {
        $this->assertSame('メモ', $this->memo->value);
    }

    /** @test */
    public function メモが50文字を超える場合は例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('memo length id expected 50, but 51.');

        new Memo('123456789012345678901234567890123456789012345678901');
    }
}
