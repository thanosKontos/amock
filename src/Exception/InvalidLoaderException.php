<?php

namespace Amock\Exception;

use InvalidArgumentException;

class InvalidLoaderException extends InvalidArgumentException
{
    public function __construct(string $type)
    {
        parent::__construct(sprintf('Invalid loader provided: %s', $type));
    }
}
