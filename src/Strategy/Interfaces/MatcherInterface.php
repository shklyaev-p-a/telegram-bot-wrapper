<?php

namespace BotWrapper\Strategy\Interfaces;

interface MatcherInterface
{
    public function match($needle, $data): bool;
}