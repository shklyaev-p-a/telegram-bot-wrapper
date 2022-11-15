<?php

namespace BotWrapper\Strategy;

use BotWrapper\Strategy\Interfaces\MatcherInterface;

class StringStrategy implements MatcherInterface
{
    public function match($signature, $data): bool
    {
        return $signature === $data;
    }
}