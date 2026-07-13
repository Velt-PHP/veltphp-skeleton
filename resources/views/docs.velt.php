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
            ->add(Text::make('Velt organise une application PHP autour d un kernel modulaire, de routes HTTP, de controllers par feature et de pages declaratives capables de produire du HTML ou du JSON.')->class('page-lead'))
            ->add(
                Card::make()
                    ->class('docs-grid')
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Kernel modulaire')->as('h2')->class('doc-title'))
                            ->add(Text::make('Le bootstrap charge l environnement, la configuration et les providers HTTP, UI et Database avant de traiter la requete.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Routes et controllers')->as('h2')->class('doc-title'))
                            ->add(Text::make('Les routes web et API deleguent a des controllers ranges par feature pour garder une structure MVC lisible.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Pages Velt')->as('h2')->class('doc-title'))
                            ->add(Text::make('Chaque vue .velt.php retourne une Page composee de composants. Le renderer web produit le HTML final.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Sortie JSON')->as('h2')->class('doc-title'))
                            ->add(Text::make('La meme structure UI peut etre serialisee pour alimenter une preview mobile ou un client consommant un schema stable.')->class('doc-text'))
                    )
            )
    );
