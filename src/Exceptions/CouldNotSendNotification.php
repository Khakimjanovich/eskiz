<?php

namespace NotificationChannels\Eskiz\Exceptions;

use Exception;

class CouldNotSendNotification extends Exception
{
    public static function serviceRespondedWithAnError($message): self
    {
        return new static('Eskiz Response: ' . $message);
    }

    public static function apiKeyNotProvided(): self
    {
        return new static('API key is missing.');
    }

    public static function serviceNotAvailable($message): self
    {
        return new static($message);
    }

    public static function phoneNumberNotProvided(): self
    {
        return new static('No phone number was provided.');
    }
}
