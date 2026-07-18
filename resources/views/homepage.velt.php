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
                    ->add(Link::make('Documentation', '/docs')->class('nav-link'))
                    ->add(Link::make('Donnees', '/database')->class('nav-link'))
            )
            ->add(
                Card::make()
                    ->class('hero-centered')
                    ->add(
                        Card::make()
                            ->class('hero-copy')
                            ->add(Text::make('Velt')->as('span')->class('hero-logo'))
                            ->add(Text::make('Framework PHP modulaire pour interfaces declaratives, API et apercus JSON.')->as('h1')->class('hero-title'))
                            ->add(Text::make('Velt v0.1.6 beta fournit un skeleton MVC par feature avec kernel, routage HTTP, rendu UI, preview mobile JSON, ORM, migrations, seeders, CLI et tests des la premiere installation.')->class('hero-subtitle'))
                            ->add(Text::make('Requiert PHP 8.2+, Composer et PDO. Node.js est optionnel pour reconstruire les assets Tailwind fournis par defaut.')->class('hero-text'))
                            ->add(
                                Card::make()
                                    ->class('hero-actions')
                                    ->add(Link::make('Commencer avec Velt', '/docs')->class('button button-primary'))
                                    ->add(Link::make('Explorer la base de donnees', '/database')->class('button button-ghost'))
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
                            ->add(Text::make('Positionnement')->as('h2')->class('feature-title'))
                            ->add(Text::make('Velt est un framework PHP moderne pour construire des applications web, des API et des sorties JSON a partir d une base modulaire.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('02')->as('small')->class('feature-index'))
                            ->add(Text::make('Installation rapide')->as('h2')->class('feature-title'))
                            ->add(Text::make('Installez avec composer create-project velt/skeleton mon-app, puis lancez php bin/velt serve pour ouvrir le projet.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('03')->as('small')->class('feature-index'))
                            ->add(Text::make('Architecture')->as('h2')->class('feature-title'))
                            ->add(Text::make('Le skeleton suit MVC et feature-based: controllers, models et vues restent proches du domaine qu ils servent.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('04')->as('small')->class('feature-index'))
                            ->add(Text::make('Outils inclus')->as('h2')->class('feature-title'))
                            ->add(Text::make('Routage natif, providers, vues .velt.php, ORM, migrations, seeders, Tailwind, CLI et base PHPUnit sont preconfigures.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('05')->as('small')->class('feature-index'))
                            ->add(Text::make('Chemin debutant')->as('h2')->class('feature-title'))
                            ->add(Text::make('La page Documentation explique installation, structure, routes, vues, configuration, securite et contribution.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('06')->as('small')->class('feature-index'))
                            ->add(Text::make('Chemin expert')->as('h2')->class('feature-title'))
                            ->add(Text::make('La couche donnees expose DB, Query Builder, Schema, Migrator, SeederRunner et modeles Active Record.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('07')->as('small')->class('feature-index'))
                            ->add(Text::make('Ecosysteme')->as('h2')->class('feature-title'))
                            ->add(Text::make('Projet open-source MIT maintenu dans les repos Velt-PHP, avec releases taguees et composants Composer separes.')->class('feature-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('feature-card')
                            ->add(Text::make('08')->as('small')->class('feature-index'))
                            ->add(Text::make('Nouveaute beta')->as('h2')->class('feature-title'))
                            ->add(Text::make('Cette version ajoute un skeleton complet: frontend Velt, backend HTTP, base SQLite, API projects et assets Tailwind.')->class('feature-text'))
                    )
            )
    );
