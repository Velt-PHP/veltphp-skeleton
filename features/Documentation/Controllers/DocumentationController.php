<?php

declare(strict_types=1);

namespace App\Documentation\Controllers;

use App\Shared\Controllers\Controller;

final class DocumentationController extends Controller
{
    public function docs(): string
    {
        return $this->view('docs');
    }

    public function database(): string
    {
        return $this->view('database');
    }
}
