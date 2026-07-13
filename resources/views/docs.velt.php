<?php

declare(strict_types=1);

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

return Page::make('Velt Documentation')
    ->layout('guest')
    ->meta([
        'title' => 'Velt Documentation',
        'description' => 'Learn the default Velt skeleton structure.',
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
                    ->add(Link::make('Database', '/database')->class('nav-link'))
            )
            ->add(Text::make('Documentation')->as('h1')->class('page-title'))
            ->add(Text::make('A Laravel-inspired starting point, adapted to Velt concepts and its declarative UI syntax.')->class('page-lead'))
            ->add(
                Card::make()
                    ->class('docs-grid')
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Routes')->as('h2')->class('doc-title'))
                            ->add(Text::make('Define web and API endpoints in routes/web.php and routes/api.php. Handlers may return strings, arrays or Velt responses.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Views')->as('h2')->class('doc-title'))
                            ->add(Text::make('Create UI screens in resources/views using .velt.php files that return Velt\\Ui\\Page instances.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Data')->as('h2')->class('doc-title'))
                            ->add(Text::make('Run php bin/velt migrate and php bin/velt db:seed to prepare the default SQLite demo database.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Assets')->as('h2')->class('doc-title'))
                            ->add(Text::make('Tailwind is configured by default. Edit resources/css/app.css and build into public/assets/app.css.')->class('doc-text'))
                    )
            )
    );
