<?php

declare(strict_types=1);

namespace Domain;

use Domain\Model\Translation;

interface Translator
{
    public function translate(string $text): Translation;
}
