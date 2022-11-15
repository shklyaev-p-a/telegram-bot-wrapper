<?php

namespace BotWrapper\Strategy;

use BotWrapper\Strategy\Interfaces\MatcherInterface;

class ArrayStrategy implements MatcherInterface
{
    public function match($array, $data): bool
    {
        return in_array($data, $array);
    }
}