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
        $response = new Response();
        if ($exception instanceof HttpExceptionInterface){
            $message = sprintf('Error: %s with code: %s',$exception->getMessage(),$exception->getStatusCode());
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        }else{
            $message = sprintf('Error: %s with code: %s',$exception->getMessage(),$exception->getCode());
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        // Customize your response object to display the exception details
        $response->setContent($message);
        $response->setContent(json_encode(array('success' => FALSE,'msg' => $message)));
        $response->headers->set('Content-Type', 'application/json');
        //return $response;
        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
                                                                                                                                                                                      	    $event->setResponse($response);                                                                                                                 
    }
}

