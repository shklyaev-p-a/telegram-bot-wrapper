<?php

use PHPUnit\Framework\TestCase;

final class BotFactoryTest extends TestCase
{
    public function setTokenTest()
    {
        $botFactory = $this->makePropertyToVisible(\BotWrapper\BotFactory::class, 'token');

        $botFactory = $botFactory->token('123');
        self::assertEquals(123, $botFactory->token);
    }

    private function makePropertyToVisible($class, $property)
    {
        $reflectionClass = new \ReflectionClass($class);
        $reflectionProperty = $reflectionClass->getProperty($property);
        $reflectionProperty->setAccessible(true);

        return $reflectionClass->newInstanceWithoutConstructor();
    }
}