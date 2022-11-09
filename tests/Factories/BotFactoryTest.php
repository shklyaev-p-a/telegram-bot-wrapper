<?php

use PHPUnit\Framework\TestCase;
use BotWrapper\Factories\BotFactory;

final class BotFactoryTest extends TestCase
{
    public function testSetToken()
    {
        $token = rand(5, 25);
        $factory = new BotFactory();

        $result = $factory->token($token);
        $this->assertInstanceOf(BotFactory::class, $result);
        $this->assertEquals($token, $factory->token);
    }

    public function testSetCommands()
    {
        $commands = [
          stdClass::class
        ];

        $factory = new BotFactory();

        $result = $factory->commands($commands);
        $this->assertInstanceOf(BotFactory::class, $result);
        $this->assertEquals($commands, $factory->commands);
    }

    public function testSetQueries()
    {
        $queries = [
            stdClass::class
        ];

        $factory = new BotFactory();

        $result = $factory->queries($queries);
        $this->assertInstanceOf(BotFactory::class, $result);
        $this->assertEquals($queries, $factory->queries);
    }

    public function testSetActions()
    {
        $actions = [
            stdClass::class
        ];

        $factory = new BotFactory();

        $result = $factory->actions($actions);
        $this->assertInstanceOf(BotFactory::class, $result);
        $this->assertEquals($actions, $factory->actions);
    }

    public function testSetMessages()
    {
        $messages = [
            stdClass::class
        ];

        $factory = new BotFactory();

        $result = $factory->messages($messages);
        $this->assertInstanceOf(BotFactory::class, $result);
        $this->assertEquals($messages, $factory->messages);
    }
}