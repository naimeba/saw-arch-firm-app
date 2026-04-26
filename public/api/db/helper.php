<?php

declare(strict_types=1);

function envValue(string $key, ?string $default = null): ?string
{
    $value = getenv($key);
    return $value !== false ? $value : $default;
}