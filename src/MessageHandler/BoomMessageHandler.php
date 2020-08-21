<?php

namespace App\MessageHandler;

use App\Message\BoomMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class BoomMessageHandler implements MessageHandlerInterface
{
    public function __invoke(BoomMessage $message)
    {
        throw new \InvalidArgumentException('This is a boom exception');
    }
}
