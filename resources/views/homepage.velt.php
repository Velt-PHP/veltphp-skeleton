<?php

declare(strict_types=1);

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

return Page::make('Velt')
    ->layout('guest')
    ->meta([
        'title' => 'Velt - Framework PHP declaratif et modulaire',
        'description' => 'Velt est un framework PHP moderne pour construire des applications web, API et previews JSON avec une UI declarative.',
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
                    ->class('hero-centered')
                    ->add(
                        Card::make()
                            ->class('hero-copy')
                            ->add(Text::make('Velt')->as('span')->class('hero-logo'))
                            ->add(Text::make('Build once. Render for web and preview.')->as('h1')->class('hero-title'))
                            ->add(Text::make('Velt est un framework PHP modulaire qui assemble kernel, HTTP, UI declarative, database, ORM et CLI dans une base claire pour developper vite sans perdre la structure.')->class('hero-subtitle'))
                            ->add(Text::make('Une page Velt est un arbre de composants PHP. Le meme code peut etre rendu en HTML pour le navigateur ou expose en JSON pour une preview mobile et des clients modernes.')->class('hero-text'))
                            ->add(
                                Card::make()
                                    ->class('hero-actions')
                                    ->add(Link::make('Explore Velt', '/docs')->class('button button-primary'))
                                    ->add(Link::make('View data layer', '/database')->class('button button-ghost'))
                            )
                    )
            )
            ->add(
                Card::make()
                    ->class('feature-grid')
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('01')->as('small')->class('feature-index'))
                            ->add(Text::make('UI declarative')->as('h2')->class('feature-title'))
                            ->add(Text::make('Composez vos interfaces avec Page, Card, Text, Form, Input et Button dans des fichiers .velt.php lisibles et testables.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('02')->as('small')->class('feature-index'))
                            ->add(Text::make('Feature based MVC')->as('h2')->class('feature-title'))
                            ->add(Text::make('Organisez chaque domaine avec ses controllers, models et vues au meme endroit pour garder la logique proche du besoin metier.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('03')->as('small')->class('feature-index'))
                            ->add(Text::make('Full-stack starter')->as('h2')->class('feature-title'))
                            ->add(Text::make('Routes web, API JSON, migrations, seeders, ORM, SQLite et Tailwind sont deja relies pour une demo complete.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('04')->as('small')->class('feature-index'))
                            ->add(Text::make('Preview ready')->as('h2')->class('feature-title'))
                            ->add(Text::make('Le rendu JSON pose les bases d une preview mobile: une interface decrite une fois, puis transformee selon le contexte.')->class('feature-text'))
                    )
            )
    );
