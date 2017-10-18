<?php

namespace Amock;

class Configuration
{
    const TYPE_YAML = 'yaml';

    const SOURCE_TYPE_DIR = 'dir';

    private $type;

    private $sourceType;

    private $value;

    public function __construct(string $type, string $sourceType, string $value)
    {
        $this->type = $type;
        $this->sourceType = $sourceType;
        $this->value = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSourceType(): string
    {
        return $this->sourceType;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
