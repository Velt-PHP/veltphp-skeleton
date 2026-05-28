<?php

declare(strict_types=1);

namespace App\Home;

use Velt\Ui\Components\Button;
use Velt\Ui\Components\Card;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;
use Velt\Ui\Renderers\WebRenderer;

final class HomePage
{
    public function show(): string
    {
        return (new WebRenderer())->render($this->page());
    }

    public function page(): Page
    {
        return Page::make('Velt')
            ->meta([
                'title' => 'Velt App',
                'description' => 'Minimal installable Velt application skeleton.',
            ])
            ->add(
                Card::make()
                    ->class('velt-home')
                    ->add(Text::make('Velt App')->as('h1'))
                    ->add(Text::make('Your Velt project is installed and ready.'))
                    ->add(Button::make('Start building')->variant('primary'))
            );
    }
}
