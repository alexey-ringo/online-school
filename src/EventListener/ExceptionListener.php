<?php
declare(strict_types=1);

namespace App\EventListener;

//Регистрация в config/services.yaml
//Дополнительная обработка всех перехваченных исклюыений
//перед отправкой response

use Symfony\Component\HttpFoundation\Response;
//Deprecated Class
//use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): ExceptionEvent
    {
        $response = new Response();       

        //$exception = $event->getException();
        $exception = $event->getThrowable();

        //Подмена LogicException на BadRequestHttpException
        if($exception instanceof \LogicException) {
            //Передаем в новое BadRequestHttpException изначальный message
            $exception = new BadRequestHttpException($exception->getMessage());
        }

        $response->setStatusCode($exception->getStatusCode());

        $response->setContent(json_encode([
            'error' => $exception->getMessage()
        ]));

        $event->setResponse($response);        

        return $event;
    }
}
