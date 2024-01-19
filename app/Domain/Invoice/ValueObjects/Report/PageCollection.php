<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Report;

use App\Domain\Invoice\ValueObjects\Report\Page;

/**
 * 請求書ページコレクション
 */
final class PageCollection
{
    /**
     * @param Page[] $pages
     */
    public function __construct(public readonly array $pages)
    {
    }

    public function getSalesCount(): int
    {
        return array_reduce(
            $this->pages,
            fn (int $c, Page $page) => $c + $page->salesCount,
            0
        );
    }

    public function getPagesCount(): int
    {
        return count($this->pages);
    }

    public function getSalesAmount(): int
    {
        return array_reduce(
            $this->pages,
            fn (int $c, Page $page) => $c + $page->salesAmount,
            0
        );
    }
}
