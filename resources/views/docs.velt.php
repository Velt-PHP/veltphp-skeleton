<?php

declare(strict_types=1);

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

return Page::make('Velt Documentation')
    ->layout('guest')
    ->meta([
        'title' => 'Documentation Velt',
        'description' => 'Documentation du skeleton Velt, de l installation aux bonnes pratiques.',
        'stylesheets' => ['/assets/app.css'],
    ])
    ->add(
        Card::make()
            ->class('page-shell compact-shell')
            ->add(
                Card::make()
                    ->class('topbar')
                    ->add(Link::make('Velt', '/')->class('logo-mark'))
                    ->add(Link::make('Accueil', '/')->class('nav-link'))
                    ->add(Link::make('Donnees', '/database')->class('nav-link'))
            )
            ->add(Text::make('Documentation Velt')->as('h1')->class('page-title'))
            ->add(Text::make('Velt organise une application PHP autour d un kernel modulaire, de routes HTTP, de controllers par feature et de pages declaratives capables de produire du HTML ou du JSON.')->class('page-lead'))
            ->add(
                Card::make()
                    ->class('docs-grid')
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Introduction')->as('h2')->class('doc-title'))
                            ->add(Text::make('Velt resout le demarrage d applications PHP modernes: structure claire, composants modulaires, UI declarative, API JSON et socle database pret pour les demos.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Prerequis')->as('h2')->class('doc-title'))
                            ->add(Text::make('PHP 8.2 ou plus, Composer, extension PDO et SQLite pour le mode local. Node.js sert uniquement a reconstruire Tailwind.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Philosophie')->as('h2')->class('doc-title'))
                            ->add(Text::make('Le kernel reste central, les providers enregistrent les modules, le container resout les services et les features regroupent la logique metier.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Demarrage rapide')->as('h2')->class('doc-title'))
                            ->add(Text::make('Commandes: composer install, cp .env.example .env, php bin/velt migrate, php bin/velt db:seed, php bin/velt serve.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Architecture')->as('h2')->class('doc-title'))
                            ->add(Text::make('Le code applicatif vit dans features. Les routes sont dans routes, les vues Velt dans resources/views et le point d entree HTTP dans public/index.php.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Guides pratiques')->as('h2')->class('doc-title'))
                            ->add(Text::make('Routes web dans routes/web.php, routes API dans routes/api.php, controllers par feature, vues .velt.php et modeles ORM dans features/*/Models.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Reference API')->as('h2')->class('doc-title'))
                            ->add(Text::make('Classes principales: Application, Router, Dispatcher, Request, Response, Page, WebRenderer, JsonRenderer, DB, Migrator et Model.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Configuration')->as('h2')->class('doc-title'))
                            ->add(Text::make('Les variables APP_NAME, APP_ENV, APP_DEBUG, APP_URL, DB_CONNECTION et DB_DATABASE pilotent le comportement local et production.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Deploiement')->as('h2')->class('doc-title'))
                            ->add(Text::make('Pointer le serveur web vers public, installer les dependances Composer, configurer .env, executer les migrations et garder APP_DEBUG=false.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Securite')->as('h2')->class('doc-title'))
                            ->add(Text::make('Le rendu echappe le contenu HTML, la database utilise des requetes preparees et les formulaires peuvent declarer une intention CSRF.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Bonnes pratiques')->as('h2')->class('doc-title'))
                            ->add(Text::make('Respecter strict_types, PSR-4, controllers minces, logique par feature, tests de route et configuration separee de l environnement.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Support')->as('h2')->class('doc-title'))
                            ->add(Text::make('Signaler les bugs via GitHub Issues dans le repo concerne. Les contributions doivent rester petites, testees et documentees.')->class('doc-text'))
                    )
            )
    );
