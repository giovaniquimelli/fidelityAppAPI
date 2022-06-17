<?php

namespace App\EventSubscriber;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Process\Process;

class KernelSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                ['refreshRoutes', 10],
            ],
        ];
    }

    public function refreshRoutes(RequestEvent $event)
    {
        if(!(bool)$_SERVER['APP_DEBUG']) {
            return;
        }
        $process = new Process(['php', '../bin/console', 'fidelity:gateway:ts:routes']);
        $process->run();
    }
}
