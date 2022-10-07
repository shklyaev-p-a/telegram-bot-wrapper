<?php

namespace BotWrapper\Factories;

use BotWrapper\Chaining\Constants\CommandTypes;
use BotWrapper\Strategy\ArrayStrategy;
use BotWrapper\Strategy\Matcher;
use BotWrapper\Strategy\RegExpStrategy;
use BotWrapper\Strategy\StringStrategy;

class MatcherFactory
{
    const STRATEGIES = [
        CommandTypes::TYPE_STRING => StringStrategy::class,
        CommandTypes::TYPE_ARRAY => ArrayStrategy::class,
        CommandTypes::TYPE_REGEXP => RegExpStrategy::class,
    ];

    public static function create(string $type): Matcher
    {
        $strategy = self::STRATEGIES[$type];
        return new Matcher(new $strategy());
    }
}