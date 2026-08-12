<?php

declare(strict_types=1);

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

$stylesheets = config('project.styling', 'tailwind') === 'none' ? [] : ['/assets/app.css'];
$panel = 'rounded-2xl border border-slate-200 bg-white p-6';
$label = 'text-xs font-semibold uppercase tracking-[0.14em] text-blue-600';
$title = 'mt-3 text-lg font-semibold tracking-tight text-slate-950';
$copy = 'mt-2 text-sm leading-6 text-slate-600';
$nav = 'text-sm font-medium text-slate-600 transition-colors hover:text-blue-600';
$github = 'inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-800 before:block before:h-4 before:w-4 before:bg-github-mark before:bg-contain before:bg-center before:bg-no-repeat before:content-[\'\']';

return Page::make('Velt Database')
    ->layout('guest')
    ->meta([
        'title' => 'Data foundation — Velt',
        'description' => 'A practical overview of the data layer included with this Velt project.',
        'stylesheets' => $stylesheets,
    ])
    ->add(
        Card::make()->class('min-h-screen bg-slate-50 bg-velt-grid bg-grid font-sans text-slate-950')
            ->add(
                Card::make()->class('mx-auto w-full max-w-6xl px-5 pb-16 pt-5 sm:px-8')
                    ->add(
                        Card::make()->class('flex min-h-14 items-center gap-5 rounded-2xl border border-slate-200 bg-white px-4')
                            ->add(Link::make('VELT', '/')->class('mr-auto text-base font-bold tracking-[0.18em] text-blue-600'))
                            ->add(Link::make('Home', '/')->class($nav))
                            ->add(Link::make('Guide', '/docs')->class($nav))
                            ->add(Link::make('GitHub', 'https://github.com/Velt-PHP')->class($github))
                    )
                    ->add(
                        Card::make()->class('grid items-end gap-7 py-14 lg:grid-cols-[1fr_.72fr] lg:py-20')
                            ->add(Card::make()->class('max-w-2xl')->add(Text::make('DATA FOUNDATION')->as('small')->class($label))->add(Text::make('A dependable place for your application data.')->as('h1')->class('mt-4 text-3xl font-semibold leading-tight tracking-[-0.035em] sm:text-4xl'))->add(Text::make('Start locally with SQLite, then move to MySQL or PostgreSQL when the product requires it. The same Velt APIs cover connections, queries, schema changes and models.')->class('mt-4 max-w-xl text-base leading-7 text-slate-600')))
                            ->add(Card::make()->class('rounded-2xl border border-slate-300 bg-slate-950 p-5')->add(Text::make('SETUP')->as('small')->class('text-xs font-semibold tracking-[0.14em] text-blue-300'))->add(Text::make('velt migrate')->class('mt-4 rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 font-mono text-sm text-blue-200'))->add(Text::make('velt db:seed')->class('mt-2 rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 font-mono text-sm text-blue-200')))
                    )
                    ->add(
                        Card::make()->class('grid gap-4 md:grid-cols-2 lg:grid-cols-3')
                            ->add(Card::make()->class($panel)->add(Text::make('CONNECTIONS')->as('small')->class($label))->add(Text::make('Choose the right driver')->as('h2')->class($title))->add(Text::make('Configure SQLite, MySQL or PostgreSQL through environment values while application code stays portable.')->class($copy)))
                            ->add(Card::make()->class($panel)->add(Text::make('QUERIES')->as('small')->class($label))->add(Text::make('Keep dynamic values bound')->as('h2')->class($title))->add(Text::make('The query builder uses prepared statements and validates identifiers instead of concatenating user input.')->class($copy)))
                            ->add(Card::make()->class($panel)->add(Text::make('SCHEMA')->as('small')->class($label))->add(Text::make('Track every database change')->as('h2')->class($title))->add(Text::make('Migrations make changes reviewable, repeatable and reversible across development and delivery environments.')->class($copy)))
                            ->add(Card::make()->class($panel)->add(Text::make('MODELS')->as('small')->class($label))->add(Text::make('Express domain records clearly')->as('h2')->class($title))->add(Text::make('Active Record models provide focused create, query, update, delete, relation and pagination operations.')->class($copy)))
                            ->add(Card::make()->class($panel)->add(Text::make('TEST DATA')->as('small')->class($label))->add(Text::make('Make local setup repeatable')->as('h2')->class($title))->add(Text::make('Seeders and factories prepare development or test fixtures without mixing them with production data.')->class($copy)))
                            ->add(Card::make()->class($panel)->add(Text::make('NEXT STEP')->as('small')->class($label))->add(Text::make('Replace the sample project model')->as('h2')->class($title))->add(Text::make('Define the first table for your domain, migrate it and cover its most important behavior with an integration test.')->class($copy)))
                    )
            )
    );
