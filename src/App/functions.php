<?php
declare(strict_types=1);

function show_r(mixed $value) {
    /** previous name dd. Print_r for instance, objects and values*/
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die();
}