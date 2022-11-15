<?php

namespace BotWrapper\Strategy;


use BotWrapper\Strategy\Interfaces\MatcherInterface;

class Matcher
{
    protected $matcher;

    public function __construct(MatcherInterface $matcher)
    {
        $this->matcher = $matcher;
    }

    public function match($signature, $needle)
    {
        return (bool)$this->matcher->match($signature, $needle);
    }
}