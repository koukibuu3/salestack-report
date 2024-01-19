<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObjects\Report;

/**
 * ファイル名を扱う値オブジェクト
 */
class FileName
{
    public readonly string $value;

    public function __construct(string $value)
    {
        $this->value = $this->trimmingNonSupportedCharacters($value);
    }

    /**
     * ファイル名に使用できない文字を取り除く
     */
    private function trimmingNonSupportedCharacters(string $value): string
    {
        return preg_replace('/[\\/:*?"<>|]/', '', $value);
    }
}
