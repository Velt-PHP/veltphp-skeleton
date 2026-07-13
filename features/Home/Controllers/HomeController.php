<?php

declare(strict_types=1);

namespace App\Home\Controllers;

use App\Shared\Controllers\Controller;

final class HomeController extends Controller
{
    public function show(): string
    {
        return $this->view('homepage');
    }
}
