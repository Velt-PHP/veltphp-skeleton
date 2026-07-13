<?php

declare(strict_types=1);

use Velt\Ui\Components\Button;
use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

return Page::make('Velt')
    ->layout('guest')
    ->meta([
        'title' => 'Velt - Build clean PHP applications',
        'description' => 'A complete Velt starter with UI, routes, database, ORM, migrations and Tailwind.',
        'stylesheets' => ['/assets/app.css'],
    ])
    ->add(
        Card::make()
            ->class('page-shell')
            ->add(
                Card::make()
                    ->class('topbar')
                    ->add(Text::make('Velt')->as('strong')->class('logo-mark'))
                    ->add(Link::make('Docs', '/docs')->class('nav-link'))
                    ->add(Link::make('Database', '/database')->class('nav-link'))
            )
            ->add(
                Card::make()
                    ->class('hero-grid')
                    ->add(
                        Card::make()
                            ->class('hero-copy')
                            ->add(Text::make('Velt')->as('h1')->class('hero-title'))
                            ->add(Text::make('A royal blue PHP framework starter for elegant full-stack demos.')->class('hero-subtitle'))
                            ->add(Text::make('The skeleton ships with declarative Velt views, HTTP routes, SQLite configuration, migrations, seeders, an ORM model and Tailwind-ready assets.')->class('hero-text'))
                            ->add(
                                Card::make()
                                    ->class('hero-actions')
                                    ->add(Link::make('Read the docs', '/docs')->class('button button-primary'))
                                    ->add(Link::make('Explore data', '/database')->class('button button-ghost'))
                            )
                    )
                    ->add(
                        Card::make()
                            ->class('preview-panel')
                            ->add(Text::make('Application ready')->as('strong')->class('panel-kicker'))
                            ->add(Text::make('frontend')->class('status-line'))
                            ->add(Text::make('backend')->class('status-line'))
                            ->add(Text::make('database')->class('status-line'))
                            ->add(Text::make('tailwind')->class('status-line'))
                            ->add(Button::make('php bin/velt serve')->variant('primary')->class('command-pill'))
                    )
            )
            ->add(
                Card::make()
                    ->class('feature-grid')
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('01')->as('small')->class('feature-index'))
                            ->add(Text::make('Declarative UI')->as('h2')->class('feature-title'))
                            ->add(Text::make('Pages are written in .velt.php files and rendered by the Velt UI renderer.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('02')->as('small')->class('feature-index'))
                            ->add(Text::make('Data included')->as('h2')->class('feature-title'))
                            ->add(Text::make('SQLite, migrations, seeders and ORM models are wired for a complete demo.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('03')->as('small')->class('feature-index'))
                            ->add(Text::make('Tailwind first')->as('h2')->class('feature-title'))
                            ->add(Text::make('The default project includes Tailwind config, source CSS and compiled demo styles.')->class('feature-text'))
                    )
            )
    );
