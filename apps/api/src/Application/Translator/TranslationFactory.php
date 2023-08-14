<?php

declare(strict_types=1);

namespace Application\Translator;

use Domain\Model\Translation;

class TranslationFactory
{
    public static function fromDeeplResponse(string $translatedLocale, string $originalText): Translation
    {
        return new Translation(
            originalText: $originalText,
            originalLocale: '',
            translatedText: '',
            translatedLocale: $translatedLocale
        );
    }
}
