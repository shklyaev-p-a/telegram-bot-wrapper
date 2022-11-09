## **Init**

```
require('vendor/autoload.php');

(new \BotWrapper\Factories\BotFactory())->token('your token')
    ->middlewares([])
    ->commands([
        BotWrapper\Examples\HelloCommand::class,
        \BotWrapper\Examples\GoodbyeCommand::class
    ])
    ->messages([
        \BotWrapper\Examples\TestMessage::class
    ])
    ->queries([])
    ->actions([])
    ->create();
 ```

bot has only one version itself. You can access to bot by way: `$bot = Bot::getInstance();`

middlewares, messages, queries and other classes must be created from abstract parents from `BotWrapper\Chaining` folder

## **Description**

This library just a simple wrapper on other library for more faster, readable and growing projects. 
This library implements next patterns: singleton (for only one bot class in application), chaining with middleware 
(for consistently bot queries binding), strategy (for choose one of three class match signature type: array, string or regexp),
and simple factories with classes builder for bot and matcher classes.

You can find example in src\Examples;

full info about using library you can find in: https://github.com/TelegramBot/Api

#### **Middlewares classes**

classes for setting lastAction (default = empty string) in bot property or other metadata who can be needed in bot lifecycle

#### **Commands classes**

comands classes is using for detect telegram command like /start or other who starting from '\\' symbol

#### **Messages classes**

messages classes is using for detect telegram reply keyboard message who sending to chat like simple text after pushing at menu button

#### **Actions classes**

action classes need be using with custom middleware class who binding in bot property lastAction id from your system as signature
it need for simple text what users sending in chat. To determine what we need to do based on the last action

For simple user input text processing you need is using messages classes

For a bot, there is no difference between reply keyboard button text and users input text.

#### **Queries classes**

action classes determine inline keyboard button data