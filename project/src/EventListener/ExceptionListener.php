<?php

namespace App\EventListener;

use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use ApiPlatform\Core\Exception\ItemNotFoundException;
use ApiPlatform\Util\RequestAttributesExtractor;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener as LegacyExceptionListener;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener extends LegacyExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $request = $event->getRequest();
        // Normalize exceptions only for routes managed by API Platform
        if (
            'html' === $request->getRequestFormat('') ||
            !((RequestAttributesExtractor::extractAttributes($request)['respond'] ?? $request->attributes->getBoolean('_api_respond', false)) || $request->attributes->getBoolean('_graphql', false))
        ) {
            return;
        }

//        $this->exceptionListener->onKernelException($event); // @phpstan-ignore-line

        $exception = $event->getThrowable();

//        var_dump($exception); exit;

        if ($exception instanceof UnexpectedValueException && $exception->getPrevious() instanceof ItemNotFoundException) {
            $violations = new ConstraintViolationList(
                [
                    new ConstraintViolation(
                        $exception->getMessage(),
                        null,
                        [],
                        '',
                        '',
                        ''
                    )
                ]
            );

            $e = new ValidationException($violations);
            $event->setThrowable($e);

            return;
        }
    }
}