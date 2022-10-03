<?php

namespace BotWrapper\Exceptions;

class BotAlreadyInitException extends \Exception
{
    protected $message = 'Bot already init. Use override method for override';
}