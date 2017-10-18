<?php

namespace Amock\Parser;

interface Parser
{
    public function parse(string $raw): array;
}
