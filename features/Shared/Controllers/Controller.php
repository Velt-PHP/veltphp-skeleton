<?php

declare(strict_types=1);

namespace App\Shared\Controllers;

use Velt\Ui\Renderers\WebRenderer;
use Velt\Ui\View\ViewFactory;

abstract class Controller
{
    protected function view(string $name): string
    {
        $views = new ViewFactory(dirname(__DIR__, 3) . '/resources/views');

        return (new WebRenderer())->render($views->make($name));
    }
}
