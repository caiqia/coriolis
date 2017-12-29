<?php

namespace Radius\PrepodBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();
        $message = sprintf(
                'Error: %s with code: %s',
                $exception->getMessage(),
                $exception->getCode()
                );
        // Customize your response object to display the exception details
        $response = new Response();
        $response->setContent($message);
        $response->setContent(json_encode(array('success' => FALSE,'msg' => $message)));
        $response->headers->set('Content-Type', 'application/json');
        //return $response;
        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
                $response->headers->replace($exception->getHeaders());
        } else {
                $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }                                                                                                                                                                               	    $event->setResponse($response);                                                                                                                 
    }
}

