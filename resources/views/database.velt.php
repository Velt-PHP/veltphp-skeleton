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

return Page::make('Velt Database')
    ->layout('guest')
    ->meta([
        'title' => 'Velt - Couche donnees',
        'description' => 'Skeleton Velt pret pour migrations, seeders, ORM et API JSON.',
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
                    ->add(Link::make('Documentation', '/docs')->class('text-sm font-semibold text-slate-600 transition hover:text-velt-blue'))
            )
            ->add(Text::make('Backend et base de donnees')->as('h1')->class('mt-12 text-4xl font-black leading-none text-velt-blue sm:text-6xl'))
            ->add(Text::make('Le skeleton Velt inclut une base donnees fonctionnelle: connexions PDO, query builder, migrations, seeders, modele ORM, SQLite et route API JSON pour une demonstration complete.')->class('mx-auto mt-4 max-w-3xl text-base leading-8 text-slate-600'))
            ->add(
                Card::make()
                    ->class('mt-9 grid w-full grid-cols-1 gap-5 text-left md:grid-cols-2')
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Configuration')->as('h2')->class($titleClass))
                            ->add(Text::make('Pilotes MVP: SQLite, MySQL et PostgreSQL via PDO. Le fichier .env definit DB_CONNECTION et DB_DATABASE.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Connexions')->as('h2')->class($titleClass))
                            ->add(Text::make('DatabaseManager lit config/database.php, cree la connexion au premier usage et reutilise l instance PDO pendant l execution.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Modeles ORM')->as('h2')->class($titleClass))
                            ->add(Text::make('Un modele declare sa table et ses champs fillable. Exemple: App\\Projects\\Models\\Project represente la table projects.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Relations')->as('h2')->class($titleClass))
                            ->add(Text::make('Le socle ORM expose hasMany et belongsTo pour preparer les liens simples. Les relations avancees viendront dans les modules suivants.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('CRUD')->as('h2')->class($titleClass))
                            ->add(Text::make('Utilisez Project::create, Project::where(...)->first, orderBy, limit, save et delete pour les operations courantes.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Query Builder')->as('h2')->class($titleClass))
                            ->add(Text::make('DB::table("projects")->where("status", "ready")->orderBy("id")->limit(10)->get() execute des requetes preparees.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Migrations')->as('h2')->class($titleClass))
                            ->add(Text::make('velt migrate cree les tables. velt migrate:rollback annule la derniere batch de migrations.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Seeders')->as('h2')->class($titleClass))
                            ->add(Text::make('velt db:seed execute DatabaseSeeder et charge des donnees de test sans dupliquer les slugs deja presents.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Transactions')->as('h2')->class($titleClass))
                            ->add(Text::make('DB::transaction regroupe plusieurs requetes et annule automatiquement l ensemble si une exception est levee.')->class($textClass))
                    )
                    ->add(
                        Card::make()
                            ->class($cardClass)
                            ->add(Text::make('Securite et performance')->as('h2')->class($titleClass))
                            ->add(Text::make('Les valeurs dynamiques passent par des bindings PDO. Le cache de resultats existe cote database; eager loading avance reste prevu pour la suite.')->class($textClass))
                    )
            )
    );
