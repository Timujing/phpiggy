<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface MiddlewareInterface
{
    //purpose of this method is to process the request. This function will be called before controller handles the request.
    public function process(callable $next);
}
