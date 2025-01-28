<?php

declare(strict_types=1);

namespace Framework;

//responsible for providing basic method for rendering the template
class TemplateEngine
{
    //setting a base path - store absolute path to the directory with templates
    public function __construct(private string $basePath) {}

    public function render(string $template) {
        include "{$this->basePath}/{$template}";
    }
}
