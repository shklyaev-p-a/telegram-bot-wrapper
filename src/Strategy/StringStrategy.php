<?php

namespace BotWrapper\Strategy;

use BotWrapper\Strategy\Interfaces\MatcherInterface;

class StringStrategy implements MatcherInterface
{
    public function match($signatureString, $needle): bool
    {
        return $signatureString === $needle;
    }
}