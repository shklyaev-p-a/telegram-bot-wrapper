<?php

namespace BotWrapper\Chaining;

abstract class Command{

    public $signature = '';

    abstract function command($bot);
}