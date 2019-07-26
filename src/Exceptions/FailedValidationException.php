<?php

namespace IntoTheSource\LaravelFormBuilder\Exceptions;

use Illuminate\Support\MessageBag;

class FailedValidationException extends \Exception
{
    /**
     * FailedValidationException constructor.
     *
     * @param \Illuminate\Support\MessageBag $messageBag
     */
    public function __construct(MessageBag $messageBag)
    {
        foreach ($messageBag->getMessages() as $field => $messages) {
            $error = ($field . ': ' . implode(', ', $messages));
        }

        parent::__construct($error);
    }
}
