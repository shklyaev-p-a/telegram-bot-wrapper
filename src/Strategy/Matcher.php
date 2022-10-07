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

    public function match($needle, $data)
    {
        return (bool)$this->matcher->match($needle, $data);
    }
}