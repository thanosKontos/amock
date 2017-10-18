<?php

namespace Amock\Exception;

use InvalidArgumentException;

class InvalidParserException extends InvalidArgumentException
{
    public function __construct(string $type)
    {
        parent::__construct(sprintf('Invalid parser provided: %s', $type));
    }
}
