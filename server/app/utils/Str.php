<?php

class Str
{
    public static function fromKebabToPascaLCase(string $value): string
    {
        return str_replace('-', '', ucwords($value, '-'));
    }

    public static function fromPascalToKebabCase(string $value): string
    {
        return strtolower(implode('-', preg_split('/(?=[A-Z])/', lcfirst($value))));
    }
}
