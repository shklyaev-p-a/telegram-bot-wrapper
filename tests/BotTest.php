<?php

use BotWrapper\Bot;
use PHPUnit\Framework\TestCase;
use TelegramBot\Api\Client;
use BotWrapper\Exceptions\BotAlreadyInitException;
use BotWrapper\Exceptions\EmptyBotException;

final class BotTest extends TestCase
{

    /**
     *
     */
    public function testUniqueness(): void
    {
        $firstCall = Bot::getInstance();
        $secondCall = Bot::getInstance();

        $this->assertInstanceOf(Bot::class, $firstCall);
        $this->assertSame($firstCall, $secondCall);
    }

    /**
     * @throw Exception
     */
    public function testInit(): void
    {
        $bot = $this->createClientMock();

        $bot->init(rand(5, 10));

        $this->assertNotNull($bot->get());
        $this->assertInstanceOf(Client::class, $bot->get());

        $this->expectException(BotAlreadyInitException::class);
        $bot->init(rand(5, 10));
    }

    /**
     *
     */
    public function testBotHasEmptyLastAction(): void
    {
        $bot = $this->createClientMock();

        $bot->init(rand(5, 10));

        $this->objectHasAttribute('lastAction', $bot);
        $this->assertEmpty($bot->get()->lastAction);
    }

    /**
     *
     */
    public function testBotHasAdditionalData(): void
    {
        $bot = $this->createClientMock();

        $bot->init(rand(5, 10), ['additional' => 'test']);
        $this->objectHasAttribute('additional', $bot);
        $this->assertEquals('test', $bot->get()->additional);
    }

    /**
     *
     */
    public function testOverride(): void
    {
        $bot = $this->createClientMock();

        $bot->override(rand(5, 10));

        $this->assertNotNull($bot->get());
        $this->assertInstanceOf(Client::class, $bot->get());
    }

    /**
     *
     */
    public function testAddAdditionalProperty(): void
    {
        $bot = $this->createClientMock();

        $bot->init(rand(5, 10));
        $bot->addAdditionalProperty('test', 'value');

        $this->assertEquals('value', $bot->get()->test);
    }

    /**
     * @throws Exception
     */
    public function testGet(): void
    {
        $this->expectException(EmptyBotException::class);
        Bot::getInstance()->get();

        $bot = $this->createClientMock();
        $bot = $bot->init(rand(4, 10));

        $this->assertNotNull($bot->get());
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function createClientMock(): \PHPUnit\Framework\MockObject\MockObject
    {
        $client = $this->createMock(Client::class);

        $bot = $this->getMockBuilder(Bot::class)
            ->disableOriginalConstructor()
            ->setMethods(['createClient'])
            ->getMock();

        $bot->expects($this->once())
            ->method('createClient')
            ->will($this->returnValue($client));

        return $bot;
    }
}