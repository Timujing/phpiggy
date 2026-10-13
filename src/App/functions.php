<?php

declare(strict_types=1);

function showReadable(mixed $value)
{
    /** previous name dd. Print_r for instance, objects and values*/
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die();
}

function escapeForDefense(mixed $value): string
{
    return htmlspecialchars((string) $value);
}
