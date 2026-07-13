<?php

declare(strict_types=1);

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Link;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

return Page::make('Velt Database')
    ->layout('guest')
    ->meta([
        'title' => 'Velt - Couche donnees',
        'description' => 'Skeleton Velt pret pour migrations, seeders, ORM et API JSON.',
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
                    ->add(Link::make('Documentation', '/docs')->class('nav-link'))
            )
            ->add(Text::make('Backend et base de donnees')->as('h1')->class('page-title'))
            ->add(Text::make('Le skeleton Velt inclut une base donnees fonctionnelle: connexions PDO, query builder, migrations, seeders, modele ORM, SQLite et route API JSON pour une demonstration complete.')->class('page-lead'))
            ->add(
                Card::make()
                    ->class('docs-grid')
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Configuration')->as('h2')->class('doc-title'))
                            ->add(Text::make('Pilotes MVP: SQLite, MySQL et PostgreSQL via PDO. Le fichier .env definit DB_CONNECTION et DB_DATABASE.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Connexions')->as('h2')->class('doc-title'))
                            ->add(Text::make('DatabaseManager lit config/database.php, cree la connexion au premier usage et reutilise l instance PDO pendant l execution.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Modeles ORM')->as('h2')->class('doc-title'))
                            ->add(Text::make('Un modele declare sa table et ses champs fillable. Exemple: App\\Projects\\Models\\Project represente la table projects.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Relations')->as('h2')->class('doc-title'))
                            ->add(Text::make('Le socle ORM expose hasMany et belongsTo pour preparer les liens simples. Les relations avancees viendront dans les modules suivants.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('CRUD')->as('h2')->class('doc-title'))
                            ->add(Text::make('Utilisez Project::create, Project::where(...)->first, orderBy, limit, save et delete pour les operations courantes.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Query Builder')->as('h2')->class('doc-title'))
                            ->add(Text::make('DB::table("projects")->where("status", "ready")->orderBy("id")->limit(10)->get() execute des requetes preparees.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Migrations')->as('h2')->class('doc-title'))
                            ->add(Text::make('php bin/velt migrate cree les tables. php bin/velt migrate:rollback annule la derniere batch de migrations.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Seeders')->as('h2')->class('doc-title'))
                            ->add(Text::make('php bin/velt db:seed execute DatabaseSeeder et charge des donnees de test sans dupliquer les slugs deja presents.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Transactions')->as('h2')->class('doc-title'))
                            ->add(Text::make('DB::transaction regroupe plusieurs requetes et annule automatiquement l ensemble si une exception est levee.')->class('doc-text'))
                    )
                    ->add(
                        Card::make()
                            ->class('doc-card')
                            ->add(Text::make('Securite et performance')->as('h2')->class('doc-title'))
                            ->add(Text::make('Les valeurs dynamiques passent par des bindings PDO. Le cache de resultats existe cote database; eager loading avance reste prevu pour la suite.')->class('doc-text'))
                    )
            )
    );
