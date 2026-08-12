<?php

declare(strict_types=1);

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

$stylesheets = config('project.styling', 'tailwind') === 'none' ? [] : ['/assets/app.css'];

return Page::make('Velt')
    ->layout('guest')
    ->meta([
        'title' => 'Velt - Framework PHP declaratif et modulaire',
        'description' => 'Velt est un framework PHP moderne pour construire des applications web, API et previews JSON avec une UI declarative.',
        'stylesheets' => $stylesheets,
    ])
    ->add(
        Card::make()
            ->class('mx-auto min-h-screen w-full max-w-6xl px-4 pb-16 pt-6 text-slate-900')
            ->add(
                Card::make()
                    ->class('flex min-h-14 w-full flex-wrap items-center gap-4')
                    ->add(Text::make('VELT')->as('strong')->class('mr-auto text-xl font-extrabold tracking-[0.2em] text-velt-blue'))
                    ->add(Link::make('Documentation', '/docs')->class('text-sm font-semibold text-slate-600 hover:text-velt-blue'))
                    ->add(Link::make('Donnees', '/database')->class('text-sm font-semibold text-slate-600 hover:text-velt-blue'))
            )
            ->add(
                Card::make()
                    ->class('flex min-h-[calc(100vh-7rem)] items-center justify-center py-14 text-center')
                    ->add(
                        Card::make()
                            ->class('mx-auto flex max-w-4xl flex-col items-center')
                            ->add(Text::make('VELT')->as('span')->class('mb-4 text-6xl font-black tracking-[0.18em] text-velt-blue sm:text-8xl'))
                            ->add(Text::make('Framework PHP modulaire pour interfaces declaratives, API et apercus JSON.')->as('h1')->class('text-2xl font-semibold leading-tight text-velt-blue sm:text-4xl'))
                            ->add(Text::make('Un skeleton MVC par feature avec kernel, routage HTTP, rendu UI, preview, ORM, migrations, seeders, CLI et tests des la premiere installation.')->class('mt-4 max-w-3xl text-lg leading-8 text-slate-900'))
                            ->add(Text::make('Requiert PHP 8.2+, Composer et PDO. Node.js est optionnel pour reconstruire les utilitaires Tailwind du profil web.')->class('mx-auto mt-3 max-w-2xl text-base leading-7 text-slate-600'))
                            ->add(
                                Card::make()
                                    ->class('mt-6 flex flex-wrap justify-center gap-3')
                                    ->add(Link::make('Commencer avec Velt', '/docs')->class('inline-flex min-h-11 items-center justify-center rounded-lg bg-velt-blue px-5 text-sm font-bold text-white shadow-lg shadow-blue-200'))
                                    ->add(Link::make('Explorer la base de donnees', '/database')->class('inline-flex min-h-11 items-center justify-center rounded-lg border border-blue-200 bg-white px-5 text-sm font-bold text-velt-blue'))
                            )
                    )
            )
            ->add(
                Card::make()
                    ->class('mt-5 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4')
                    ->add(
                        Card::make()
                            ->class('min-h-48 rounded-lg border border-blue-100 bg-white p-6 shadow-sm')
                            ->add(Text::make('01')->as('small')->class('text-sm font-bold text-velt-blue'))
                            ->add(Text::make('Positionnement')->as('h2')->class('mt-4 text-lg font-bold text-slate-900'))
                            ->add(Text::make('Velt est un framework PHP moderne pour construire des applications web, des API et des sorties JSON a partir d une base modulaire.')->class('mt-3 text-sm leading-7 text-slate-600'))
                    )
                    ->add(
                        Card::make()
                            ->class('min-h-48 rounded-lg border border-blue-100 bg-white p-6 shadow-sm')
                            ->add(Text::make('02')->as('small')->class('text-sm font-bold text-velt-blue'))
                            ->add(Text::make('Installation rapide')->as('h2')->class('mt-4 text-lg font-bold text-slate-900'))
                            ->add(Text::make('Installez avec velt new mon-app, puis lancez velt serve pour ouvrir le projet.')->class('mt-3 text-sm leading-7 text-slate-600'))
                    )
                    ->add(
                        Card::make()
                            ->class('min-h-48 rounded-lg border border-blue-100 bg-white p-6 shadow-sm')
                            ->add(Text::make('03')->as('small')->class('text-sm font-bold text-velt-blue'))
                            ->add(Text::make('Architecture')->as('h2')->class('mt-4 text-lg font-bold text-slate-900'))
                            ->add(Text::make('Le skeleton suit MVC et feature-based: controllers, models et vues restent proches du domaine qu ils servent.')->class('mt-3 text-sm leading-7 text-slate-600'))
                    )
                    ->add(
                        Card::make()
                            ->class('min-h-48 rounded-lg border border-blue-100 bg-white p-6 shadow-sm')
                            ->add(Text::make('04')->as('small')->class('text-sm font-bold text-velt-blue'))
                            ->add(Text::make('Outils inclus')->as('h2')->class('mt-4 text-lg font-bold text-slate-900'))
                            ->add(Text::make('Routage natif, providers, vues .velt.php, ORM, migrations, seeders, Tailwind, CLI et base PHPUnit sont preconfigures.')->class('mt-3 text-sm leading-7 text-slate-600'))
                    )
                    ->add(
                        Card::make()
                            ->class('min-h-48 rounded-lg border border-blue-100 bg-white p-6 shadow-sm')
                            ->add(Text::make('05')->as('small')->class('text-sm font-bold text-velt-blue'))
                            ->add(Text::make('Chemin debutant')->as('h2')->class('mt-4 text-lg font-bold text-slate-900'))
                            ->add(Text::make('La page Documentation explique installation, structure, routes, vues, configuration, securite et contribution.')->class('mt-3 text-sm leading-7 text-slate-600'))
                    )
                    ->add(
                        Card::make()
                            ->class('min-h-48 rounded-lg border border-blue-100 bg-white p-6 shadow-sm')
                            ->add(Text::make('06')->as('small')->class('text-sm font-bold text-velt-blue'))
                            ->add(Text::make('Chemin expert')->as('h2')->class('mt-4 text-lg font-bold text-slate-900'))
                            ->add(Text::make('La couche donnees expose DB, Query Builder, Schema, Migrator, SeederRunner et modeles Active Record.')->class('mt-3 text-sm leading-7 text-slate-600'))
                    )
                    ->add(
                        Card::make()
                            ->class('min-h-48 rounded-lg border border-blue-100 bg-white p-6 shadow-sm')
                            ->add(Text::make('07')->as('small')->class('text-sm font-bold text-velt-blue'))
                            ->add(Text::make('Ecosysteme')->as('h2')->class('mt-4 text-lg font-bold text-slate-900'))
                            ->add(Text::make('Projet open-source MIT maintenu dans les repos Velt-PHP, avec releases taguees et composants Composer separes.')->class('mt-3 text-sm leading-7 text-slate-600'))
                    )
                    ->add(
                        Card::make()
                            ->class('min-h-48 rounded-lg border border-blue-100 bg-white p-6 shadow-sm')
                            ->add(Text::make('08')->as('small')->class('text-sm font-bold text-velt-blue'))
                            ->add(Text::make('Nouveaute beta')->as('h2')->class('mt-4 text-lg font-bold text-slate-900'))
                            ->add(Text::make('Cette version ajoute un skeleton complet: frontend Velt, backend HTTP, base SQLite, API projects et assets Tailwind.')->class('mt-3 text-sm leading-7 text-slate-600'))
                    )
            )
    );
