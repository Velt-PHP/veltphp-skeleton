<?php

declare(strict_types=1);

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

return Page::make('Velt Database')
    ->layout('guest')
    ->meta([
        'title' => 'Velt Database Demo',
        'description' => 'Database-ready Velt skeleton.',
        'stylesheets' => ['/assets/app.css'],
    ])
    ->add(
        Card::make()
            ->class('page-shell compact-shell')
            ->add(
                Card::make()
                    ->class('topbar')
                    ->add(Link::make('Velt', '/')->class('logo-mark'))
                    ->add(Link::make('Home', '/')->class('nav-link'))
                    ->add(Link::make('Docs', '/docs')->class('nav-link'))
            )
            ->add(Text::make('Backend and database')->as('h1')->class('page-title'))
            ->add(Text::make('The starter is ready for a real demo: migrations create tables, seeders add data, models expose records and API routes return JSON.')->class('page-lead'))
            ->add(
                Card::make()
                    ->class('timeline')
                    ->add(Text::make('php bin/velt migrate')->as('strong')->class('timeline-command'))
                    ->add(Text::make('Creates the migrations table and the default projects table.')->class('timeline-text'))
                    ->add(Text::make('php bin/velt db:seed')->as('strong')->class('timeline-command'))
                    ->add(Text::make('Loads demo projects without duplicating existing slugs.')->class('timeline-text'))
                            ->add(Text::make('GET /api/projects')->as('strong')->class('timeline-command'))
                    ->add(Text::make('Returns ORM-backed JSON from App\\Projects\\Models\\Project.')->class('timeline-text'))
            )
    );
