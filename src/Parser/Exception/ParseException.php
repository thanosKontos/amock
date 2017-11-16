<?php

namespace Amock\Parser\Exception;

use LogicException;

class ParseException extends LogicException
{
    public function __construct()
    {
        parent::__construct(sprintf('Parse exception'));
    }
}
