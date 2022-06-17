<?php


namespace App\Events;


use App\Exception\ApiExceptionInterface;
use App\Exception\ApiFlattenException;
use App\Util\ApiResponseBag;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\Process\Process;
use Throwable;

class AppEventListener implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            // KernelEvents::EXCEPTION => 'onKernelException',
            // KernelEvents::REQUEST => 'onKernelRequest'
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        /** @var ApiExceptionInterface|HttpException|Throwable $e */
        $e = $event->getThrowable();

        $statusCode = 500;
        $response = null;

        $interfaces = array_keys(class_implements($e));
        if (in_array(ApiExceptionInterface::class, $interfaces, true)) {
            $statusCode = $e->getStatusCode();
            $response = ApiResponseBag::fail($e)->getResponse();
        } else if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
            $response = ApiResponseBag::error($e)->getResponse();
        } else {
            $response = ApiResponseBag::unknownError($e)->getResponse();
        }

//      if ($this->debug && $statusCode >= 500) {
//          return;
//      }


        if ($event->getRequest()->getContentType() === 'json') {
            $event->setResponse($response);
        }
//        } else {
//            $event->setResponse(Response::create('ocorreu um erro.' . $event->getThrowable()->getMessage()), 500);
//        }
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if(!(bool)$_SERVER['APP_DEBUG']) {
            return;
        }
        // $process = new Process(['php', '../bin/console', 'fidelity:gateway:ts:routes']);
        // $process->run();
    }
}
