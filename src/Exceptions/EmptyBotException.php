<?php

namespace BotWrapper\Exceptions;

class EmptyBotException extends \Exception
{
    protected $message = 'Bot is empty. First step use bot init method';
}