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

return Page::make('Velt Documentation')
    ->layout('guest')
    ->meta([
        'title' => 'Project guide — Velt',
        'description' => 'The essential guide for building and shipping this Velt application.',
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
                            ->add(Link::make('Data', '/database')->class($nav))
                            ->add(Link::make('GitHub', 'https://github.com/Velt-PHP')->class($github))
                    )
                    ->add(
                        Card::make()->class('grid gap-8 py-14 lg:grid-cols-[.72fr_1.28fr] lg:py-20')
                            ->add(
                                Card::make()->class('lg:sticky lg:top-6 lg:self-start')
                                    ->add(Text::make('PROJECT GUIDE')->as('small')->class($label))
                                    ->add(Text::make('Build the application one clear feature at a time.')->as('h1')->class('mt-4 text-3xl font-semibold leading-tight tracking-[-0.035em] text-slate-950 sm:text-4xl'))
                                    ->add(Text::make('This starter connects the framework essentials so you can focus on product behavior. Begin with one route, one feature and one useful test.')->class('mt-4 max-w-md text-base leading-7 text-slate-600'))
                                    ->add(Link::make('Explore the data layer', '/database')->class('mt-6 inline-flex rounded-xl border border-blue-700 border-b-4 bg-blue-600 px-5 py-3 text-sm font-semibold text-white active:translate-y-[2px] active:border-b-2'))
                            )
                            ->add(
                                Card::make()->class('grid gap-4 md:grid-cols-2')
                                    ->add(Card::make()->class($panel)->add(Text::make('01 · Run locally')->as('small')->class($label))->add(Text::make('Start the development server')->as('h2')->class($title))->add(Text::make('Use velt serve after installing the CLI globally. From this repository, php velt serve provides the project-local fallback.')->class($copy)))
                                    ->add(Card::make()->class($panel)->add(Text::make('02 · Add a feature')->as('small')->class($label))->add(Text::make('Keep product code together')->as('h2')->class($title))->add(Text::make('Create controllers, models and services inside features/<Name>. Routes remain small and point to application behavior.')->class($copy)))
                                    ->add(Card::make()->class($panel)->add(Text::make('03 · Design a screen')->as('small')->class($label))->add(Text::make('Use declarative Velt views')->as('h2')->class($title))->add(Text::make('Views in resources/views return a Page composed from typed components. Tailwind handles the Web presentation.')->class($copy)))
                                    ->add(Card::make()->class($panel)->add(Text::make('04 · Configure safely')->as('small')->class($label))->add(Text::make('Keep environments separate')->as('h2')->class($title))->add(Text::make('Store local settings in .env, keep secrets outside Git and use config() from application code.')->class($copy)))
                                    ->add(Card::make()->class($panel)->add(Text::make('05 · Persist data')->as('small')->class($label))->add(Text::make('Migrate before serving users')->as('h2')->class($title))->add(Text::make('Run velt migrate, seed only development data and use prepared Database or ORM operations.')->class($copy)))
                                    ->add(Card::make()->class($panel)->add(Text::make('06 · Verify behavior')->as('small')->class($label))->add(Text::make('Make every change testable')->as('h2')->class($title))->add(Text::make('Run composer test and npm run build. Add a regression test beside each route, service or data behavior you change.')->class($copy)))
                                    ->add(Card::make()->class($panel)->add(Text::make('07 · Prepare delivery')->as('small')->class($label))->add(Text::make('Ship from a clean build')->as('h2')->class($title))->add(Text::make('Install production dependencies, compile assets, expose only public/ and disable sensitive debug output.')->class($copy)))
                                    ->add(Card::make()->class($panel)->add(Text::make('08 · Get support')->as('small')->class($label))->add(Text::make('Work with the community')->as('h2')->class($title))->add(Text::make('Open an issue in the repository that owns the behavior. Include a reproduction, expected result and environment details.')->class($copy)))
                            )
                    )
            )
    );
