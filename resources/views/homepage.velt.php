<?php

declare(strict_types=1);

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

$stylesheets = config('project.styling', 'tailwind') === 'none' ? [] : ['/assets/app.css'];
$panel = 'rounded-2xl border border-slate-200 bg-white p-6';
$eyebrow = 'text-xs font-semibold uppercase tracking-[0.16em] text-blue-600';
$heading = 'mt-3 text-xl font-semibold tracking-tight text-slate-950';
$copy = 'mt-2 text-sm leading-6 text-slate-600';
$nav = 'text-sm font-medium text-slate-600 transition-colors hover:text-blue-600';
$github = 'github-link inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-800 before:block before:h-4 before:w-4 before:bg-github-mark before:bg-contain before:bg-center before:bg-no-repeat before:content-[\'\']';
$primary = 'inline-flex items-center justify-center rounded-xl border border-blue-700 border-b-4 bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition active:translate-y-[2px] active:border-b-2';
$secondary = 'inline-flex items-center justify-center rounded-xl border border-slate-300 border-b-4 bg-white px-5 py-3 text-sm font-semibold text-slate-800 transition active:translate-y-[2px] active:border-b-2';

return Page::make('Velt')
    ->layout('guest')
    ->meta([
        'title' => 'Velt — Build your next application',
        'description' => 'A clean Velt starter for web applications, APIs and cross-platform products.',
        'stylesheets' => $stylesheets,
    ])
    ->add(
        Card::make()->class('min-h-screen bg-slate-50 bg-velt-grid bg-grid font-sans text-slate-950')
            ->add(
                Card::make()->class('mx-auto w-full max-w-6xl px-5 pb-16 pt-5 sm:px-8')
                    ->add(
                        Card::make()->class('flex min-h-14 items-center gap-5 rounded-2xl border border-slate-200 bg-white px-4')
                            ->add(Link::make('VELT', '/')->class('mr-auto text-base font-bold tracking-[0.18em] text-blue-600'))
                            ->add(Link::make('Guide', '/docs')->class($nav))
                            ->add(Link::make('Data', '/database')->class($nav))
                            ->add(Link::make('GitHub', 'https://github.com/Velt-PHP')->class($github))
                    )
                    ->add(
                        Card::make()->class('grid items-center gap-8 py-16 lg:grid-cols-[1.15fr_.85fr] lg:py-24')
                            ->add(
                                Card::make()->class('max-w-2xl')
                                    ->add(Text::make('YOUR VELT APPLICATION IS READY')->as('small')->class($eyebrow))
                                    ->add(Text::make('A focused starting point for the product you want to ship.')->as('h1')->class('mt-4 max-w-xl text-4xl font-semibold leading-[1.08] tracking-[-0.04em] text-slate-950 sm:text-5xl'))
                                    ->add(Text::make('Build the first feature, connect your data and keep the architecture understandable as the application grows. Velt provides the foundation without imposing unnecessary layers.')->class('mt-5 max-w-xl text-base leading-7 text-slate-600'))
                                    ->add(
                                        Card::make()->class('mt-7 flex flex-wrap gap-3')
                                            ->add(Link::make('Open the project guide', '/docs')->class($primary))
                                            ->add(Link::make('Review the data layer', '/database')->class($secondary))
                                    )
                            )
                            ->add(
                                Card::make()->class('rounded-2xl border border-slate-300 bg-white p-3')
                                    ->add(
                                        Card::make()->class('rounded-xl border border-slate-200 bg-slate-950 p-5 text-slate-100')
                                            ->add(Text::make('FIRST RUN')->as('small')->class('text-xs font-semibold tracking-[0.14em] text-blue-300'))
                                            ->add(Text::make('Create, prepare, launch.')->as('h2')->class('mt-3 text-lg font-semibold'))
                                            ->add(Text::make('velt new my-app')->class('mt-5 rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 font-mono text-sm text-blue-200'))
                                            ->add(Text::make('cd my-app && velt serve')->class('mt-2 rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 font-mono text-sm text-blue-200'))
                                            ->add(Text::make('This page lives in resources/views/homepage.velt.php. Replace it with your first product screen.')->class('mt-5 text-sm leading-6 text-slate-400'))
                                    )
                            )
                    )
                    ->add(
                        Card::make()->class('grid gap-4 md:grid-cols-3')
                            ->add(Card::make()->class($panel)->add(Text::make('01 · Structure')->as('small')->class($eyebrow))->add(Text::make('Organize around features')->as('h2')->class($heading))->add(Text::make('Keep controllers, models and services close to the product capability they implement.')->class($copy)))
                            ->add(Card::make()->class($panel)->add(Text::make('02 · Interface')->as('small')->class($eyebrow))->add(Text::make('Compose screens with Velt')->as('h2')->class($heading))->add(Text::make('Use declarative PHP components that can produce Web or versioned Preview output.')->class($copy)))
                            ->add(Card::make()->class($panel)->add(Text::make('03 · Delivery')->as('small')->class($eyebrow))->add(Text::make('Start with working defaults')->as('h2')->class($heading))->add(Text::make('Routing, configuration, database tooling, tests and Tailwind are connected from the first run.')->class($copy)))
                    )
                    ->add(
                        Card::make()->class('mt-8 flex flex-col gap-4 rounded-2xl border border-blue-200 bg-blue-50 p-6 sm:flex-row sm:items-center')
                            ->add(Card::make()->class('mr-auto')->add(Text::make('Ready for your first feature?')->as('h2')->class('text-lg font-semibold text-slate-950'))->add(Text::make('Read the short guide, then replace the starter content with your own domain.')->class('mt-1 text-sm text-slate-600')))
                            ->add(Link::make('Read the guide', '/docs')->class($primary))
                    )
            )
    );
