<?php

namespace BotWrapper\Strategy;

use BotWrapper\Strategy\Interfaces\MatcherInterface;

class RegExpStrategy implements MatcherInterface
{
    public function match($signaturePattern, $needle): bool
    {
        return preg_match($signaturePattern, $needle);
    }
}