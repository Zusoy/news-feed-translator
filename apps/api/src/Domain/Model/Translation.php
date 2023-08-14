<?php

declare(strict_types=1);

namespace Domain\Model;

use Domain\Identity\Identifiable;
use Domain\Identity\Identifier;
use Stringable;

class Translation implements Identifiable, Stringable
{
    private readonly Identifier $id;
    public readonly string $originalText;
    public readonly string $originalLocale;
    public readonly string $translatedText;
    public readonly string $translatedLocale;

    public function __construct(string $originalText, string $originalLocale, string $translatedText, string $translatedLocale)
    {
        $this->id = Identifier::generate();
        $this->originalText = $originalText;
        $this->originalLocale = $originalLocale;
        $this->translatedText = $translatedText;
        $this->translatedLocale = $translatedLocale;
    }

    public function getIdentifier(): Identifier
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->translatedText;
    }
}
