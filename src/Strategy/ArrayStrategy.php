<?php

namespace BotWrapper\Strategy;

use BotWrapper\Strategy\Interfaces\MatcherInterface;

class ArrayStrategy implements MatcherInterface
{
    public function match($signatureArray, $needle): bool
    {
        return in_array($needle, $signatureArray);
    }
}