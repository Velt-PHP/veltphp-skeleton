# Velt Skeleton

Velt Skeleton est le point de depart officiel pour creer une application Velt. Il fournit une base production-ready pour une demo complete: frontend declaratif, routes HTTP, API JSON, configuration, base de donnees, migrations, seeders, ORM, Tailwind et tests.

Velt reste volontairement simple: une application PHP moderne, organisee en MVC + feature-based, avec une syntaxe UI declarative en `.velt.php`.

## Installation

```bash
composer install
cp .env.example .env
php bin/velt migrate
php bin/velt db:seed
php bin/velt serve
php bin/velt preview
```

Sur Windows PowerShell:

```powershell
composer install
Copy-Item .env.example .env
php bin/velt migrate
php bin/velt db:seed
php bin/velt serve
php bin/velt preview
```

L'application demarre par defaut sur `http://127.0.0.1:8000`.

## Stack incluse

- `velt/framework` pour l'assemblage applicatif.
- `velt/http` pour les routes, requetes, reponses et dispatch.
- `velt/ui` pour les pages declaratives `.velt.php`.
- `velt/database` pour PDO, query builder, schema builder, migrations et seeders.
- `velt/orm` pour les modeles Active Record.
- Tailwind CSS configure par defaut.
- PHPUnit pour les tests de fumee et d'integration.

## Architecture

Le skeleton suit une architecture MVC + feature-based.

```text
features/
  Home/
    Controllers/
      HomeController.php
  Documentation/
    Controllers/
      DocumentationController.php
  Projects/
    Controllers/
      ProjectApiController.php
    Models/
      Project.php
  Shared/
    Controllers/
      Controller.php

resources/
  views/
    homepage.velt.php
    docs.velt.php
    database.velt.php
  css/
    app.css

database/
  migrations/
    2026_07_13_000000_create_projects_table.php
  seeders/
    DatabaseSeeder.php

routes/
  web.php
  api.php
```

Chaque feature regroupe sa logique applicative. Les controllers restent dans `features/*/Controllers`, les models dans `features/*/Models`, et les vues declaratives dans `resources/views`.

## Routes

| Methode | URI | Action |
| --- | --- | --- |
| GET | `/` | Page welcome Velt |
| GET | `/docs` | Documentation rapide du projet |
| GET | `/database` | Explication backend et database |
| GET | `/api/projects` | JSON depuis `App\Projects\Models\Project` |
| GET | `/api/preview/{id}` | JSON minimal pour la preview mobile |
| GET | `/api/session/{id}` | Informations de session preview |
| GET | `/api/preview/demo` | Erreur JSON propre pour la preview sans session |

## Vues Velt

Les pages ne sont pas ecrites en HTML brut. Une vue Velt retourne une instance `Velt\Ui\Page`.

```php
<?php

use Velt\Ui\Components\Card;
use Velt\Ui\Components\Text;
use Velt\Ui\Page;

return Page::make('Dashboard')
    ->meta(['title' => 'Dashboard - Velt'])
    ->add(
        Card::make()
            ->class('panel')
            ->add(Text::make('Bienvenue')->as('h1'))
    );
```

Le rendu web est assure par `Velt\Ui\Renderers\WebRenderer`.

## Base de donnees

SQLite est configure par defaut pour faciliter les demos locales.

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Lancer les migrations:

```bash
php bin/velt migrate
```

Charger les donnees de demo:

```bash
php bin/velt db:seed
```

Rollback de la derniere batch:

```bash
php bin/velt migrate:rollback
```

Exemple de modele:

```php
namespace App\Projects\Models;

use Velt\Orm\Model;

final class Project extends Model
{
    protected static string $table = 'projects';
}
```

## Tailwind

Tailwind est inclus par defaut pour que chaque nouveau projet Velt ait une base frontend propre.

```bash
npm install
npm run build
```

Fichiers principaux:

- `tailwind.config.js`
- `postcss.config.js`
- `resources/css/app.css`
- `public/assets/app.css`

La page welcome utilise une identite blanche et bleu royal vers bleu ciel, avec le logo Velt dans `public/assets/velt-logo.png`.

## CLI

```bash
php bin/velt help
php bin/velt serve
php bin/velt kernel:check
php bin/velt preview [host:port]
php bin/velt migrate
php bin/velt migrate:rollback
php bin/velt db:seed
```

## Tests

```bash
composer test
```

Les tests couvrent:

- rendu de la page welcome;
- pages `/docs` et `/database`;
- migration `projects`;
- seeder `DatabaseSeeder`;
- modele ORM `Project`;
- API `/api/projects`;
- contrat JSON de `/api/preview/demo`;
- creation de session preview, QR SVG et JSON `Welcome!`.

## Checklist production

Avant publication:

```bash
composer validate
composer install
composer test
php bin/velt kernel:check
php bin/velt migrate
php bin/velt db:seed
```

Pour une release Packagist, taguer le repo seulement quand cette checklist est verte.
