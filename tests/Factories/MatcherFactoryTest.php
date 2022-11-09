<?php

use PHPUnit\Framework\TestCase;
use BotWrapper\Factories\MatcherFactory;
use BotWrapper\Strategy\Matcher;

final class MatcherFactoryTest extends TestCase
{
    public function testCreateMatchery()
    {
        foreach (MatcherFactory::STRATEGIES as $strategyName => $strategyClass) {
            $matcher = MatcherFactory::create($strategyName);
            $this->assertInstanceOf(Matcher::class, $matcher);
        }
    }
}