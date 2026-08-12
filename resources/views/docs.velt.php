<?php

declare(strict_types=1);

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

$stylesheets = config('project.styling', 'tailwind') === 'none' ? [] : ['/assets/app.css'];
$cardClass = 'min-h-48 rounded-lg border border-blue-100 bg-white p-6 shadow-sm';
$titleClass = 'text-lg font-bold text-slate-900';
$textClass = 'mt-3 text-sm leading-7 text-slate-600';

return Page::make('Velt Documentation')
    ->layout('guest')
    ->meta([
        'title' => 'Documentation Velt',
        'description' => 'Documentation du skeleton Velt, de l installation aux bonnes pratiques.',
        'stylesheets' => $stylesheets,
    ])
    ->add(
        Card::make()
            ->class('mx-auto flex min-h-screen w-full max-w-6xl flex-col items-center px-4 pb-16 pt-6 text-center text-slate-900')
            ->add(
                Card::make()
                    ->class('flex w-full items-center gap-5 border-b border-blue-100 pb-5')
                    ->add(Link::make('VELT', '/')->class('mr-auto text-xl font-extrabold tracking-[0.2em] text-velt-blue'))
                    ->add(Link::make('Accueil', '/')->class('text-sm font-semibold text-slate-600 transition hover:text-velt-blue'))
                    ->add(Link::make('Donnees', '/database')->class('text-sm font-semibold text-slate-600 transition hover:text-velt-blue'))
            )
            ->add(Text::make('Documentation Velt')->as('h1')->class('mt-12 text-4xl font-black leading-none text-velt-blue sm:text-6xl'))
            ->add(Text::make('Velt organise une application PHP autour d un kernel modulaire, de routes HTTP, de controllers par feature et de pages declaratives capables de produire du HTML ou du JSON.')->class('mx-auto mt-4 max-w-3xl text-base leading-8 text-slate-600'))
            ->add(
                Card::make()
                    ->class('mt-9 grid w-full grid-cols-1 gap-5 text-left md:grid-cols-2')
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Introduction')->as('h2')->class($titleClass))
                            ->add(Text::make('Velt resout le demarrage d applications PHP modernes: structure claire, composants modulaires, UI declarative, API JSON et socle database pret pour les demos.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Prerequis')->as('h2')->class($titleClass))
                            ->add(Text::make('PHP 8.2 ou plus, Composer, extension PDO et SQLite pour le mode local. Node.js sert uniquement a reconstruire Tailwind.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Philosophie')->as('h2')->class($titleClass))
                            ->add(Text::make('Le kernel reste central, les providers enregistrent les modules, le container resout les services et les features regroupent la logique metier.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Demarrage rapide')->as('h2')->class($titleClass))
                            ->add(Text::make('Commandes: velt new mon-app, velt migrate, velt db:seed et velt serve. Le binaire global velt est l interface publique.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Architecture')->as('h2')->class($titleClass))
                            ->add(Text::make('Le code applicatif vit dans features. Les routes sont dans routes, les vues Velt dans resources/views et le point d entree HTTP dans public/index.php.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Guides pratiques')->as('h2')->class($titleClass))
                            ->add(Text::make('Routes web dans routes/web.php, routes API dans routes/api.php, controllers par feature, vues .velt.php et modeles ORM dans features/*/Models.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Reference API')->as('h2')->class($titleClass))
                            ->add(Text::make('Classes principales: Application, Router, Dispatcher, Request, Response, Page, WebRenderer, JsonRenderer, DB, Migrator et Model.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Configuration')->as('h2')->class($titleClass))
                            ->add(Text::make('Les variables APP_NAME, APP_ENV, APP_DEBUG, APP_URL, DB_CONNECTION et DB_DATABASE pilotent le comportement local et production.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Deploiement')->as('h2')->class($titleClass))
                            ->add(Text::make('Pointer le serveur web vers public, installer les dependances Composer, configurer .env, executer les migrations et garder APP_DEBUG=false.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Securite')->as('h2')->class($titleClass))
                            ->add(Text::make('Le rendu echappe le contenu HTML, la database utilise des requetes preparees et les formulaires peuvent declarer une intention CSRF.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Bonnes pratiques')->as('h2')->class($titleClass))
                            ->add(Text::make('Respecter strict_types, PSR-4, controllers minces, logique par feature, tests de route et configuration separee de l environnement.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Support')->as('h2')->class($titleClass))
                            ->add(Text::make('Signaler les bugs via GitHub Issues dans le repo concerne. Les contributions doivent rester petites, testees et documentees.')->class($textClass))
                    )
            )
    );
