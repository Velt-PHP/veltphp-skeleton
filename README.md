# Velt Skeleton

Velt Skeleton est le point de depart officiel pour creer une application Velt. Il fournit une base production-ready pour une demo complete: frontend declaratif, routes HTTP, API JSON, configuration, base de donnees, migrations, seeders, ORM, Tailwind et tests.

Velt reste volontairement simple: une application PHP moderne, organisee en MVC + feature-based, avec une syntaxe UI declarative en `.velt.php`.

> Statut : bêta. Les profils Web et API sont fonctionnels ; le profil cross-platform reste expérimental tant que le runtime PHP/JNI, le renderer Compose et la chaîne APK ne passent pas leurs tests instrumentés.

Un profil n’est pas un drapeau cosmétique. Le configurateur réécrit les dépendances et supprime physiquement les couches inutiles. Une API ne contient donc ni pages, ni assets, ni configuration Node ; une application Web n’embarque pas Android ; une application cross-platform déclare son manifeste natif.

## Installation

```bash
composer global require velt/cli
velt new my-app
cd my-app
velt migrate
velt db:seed
velt serve
```

## Profils réellement séparés

```bash
velt new site --type=web --styling=tailwind
velt new service --type=api --database=pgsql
velt new everywhere --type=cross-platform --database=sqlite
```

- `web` conserve les routes/pages web et installe Tailwind par défaut, puis génère immédiatement `public/assets/app.css`.
- `api` retire physiquement les vues, assets, dépendance UI, Preview, Node, Tailwind et routes web.
- `cross-platform` conserve web/API/Preview, ajoute NativeWind, le manifeste `native/velt.json`, PHP 8.4 et les dépendances natives expérimentales.

Le profil cross-platform reste une prérelease jusqu’à la validation du vrai bridge JNI, du renderer Compose et de l’APK signé. Aucun framework applicatif externe n’est intégré : le runtime, le kernel, HTTP, UI, database et ORM restent 100 % Velt ; seuls les outils de style sont externes.

### Comparaison des sorties

| Élément | Web | API | Cross-platform |
| --- | --- | --- | --- |
| routes Web et vues Velt | oui | non | oui |
| routes API | oui | oui | oui |
| Preview | non après configuration | non | oui |
| styling | Tailwind par défaut | absent | NativeWind |
| Node/package.json | selon styling | absent | oui |
| `native/velt.json` | absent | absent | présent |
| PHP minimum | 8.2 | 8.2 | 8.4 |

Le configurateur intervient pendant `velt new`; ce n’est pas un convertisseur sans perte entre profils pour un projet déjà développé.

L'application ecoute par defaut sur toutes les interfaces (`0.0.0.0:8000`).
`velt preview` detecte l'adresse reseau du PC et la place dans le QR:

```bash
velt serve
velt preview
```

Le terminal affiche l'URL locale et l'URL mobile. Le telephone doit etre sur le
meme Wi-Fi. Si la detection automatique ne convient pas, l'adresse peut etre
fournie explicitement:

```bash
velt serve 0.0.0.0:8000
velt preview 192.168.1.20:8000
```

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

```text
public/index.php -> bootstrap/app.php -> kernel/providers -> routeur
    -> contrôleur de feature -> service/modèle -> Response ou page Velt
```

Les règles métier ne doivent pas vivre dans `public/index.php`, les vues ou les fichiers de routes.

## Routes

| Methode | URI | Action |
| --- | --- | --- |
| GET | `/` | Page welcome Velt |
| GET | `/docs` | Documentation rapide du projet |
| GET | `/database` | Explication backend et database |
| GET | `/api/projects` | JSON depuis `App\Projects\Models\Project` |
| GET | `/api/preview/{id}` | JSON Velt de la vue associee a une session preview |
| GET | `/api/preview-route/{path}` | JSON Velt pour une route web connue (`docs`, `database`, `homepage`) |
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
            ->class('rounded-lg border border-slate-200 bg-white p-6 shadow-sm')
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
velt migrate
```

Charger les donnees de demo:

```bash
velt db:seed
```

Rollback de la derniere batch:

```bash
velt migrate:rollback
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

Tailwind est inclus par defaut dans le profil web. `resources/css/app.css` ne contient que les trois directives Tailwind; les vues utilisent directement les utilitaires, sans couche CSS artisanale. Le profil API ne charge aucun asset web et la CLI saute l'installation Node.

NativeWind sera le preset du profil universel web + Android. Ce profil ne sera proposé par `velt new` qu'une fois le renderer Compose et la chaîne APK réellement disponibles; l'installer dans un projet web PHP actuel créerait une fausse promesse de compatibilité React Native.

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
velt help
velt serve
velt kernel:check
velt preview [host:port] [view]
velt preview docs
velt migrate
velt migrate:rollback
velt db:seed
velt project:configure --type=web --styling=tailwind --database=sqlite
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
- creation de session preview, QR SVG et JSON de la vraie vue Velt;
- navigation JSON preview pour les routes documentees.

## Checklist production

Avant publication:

```bash
composer validate
composer install
composer test
velt kernel:check
velt migrate
velt db:seed
```

Pour une release Packagist, taguer le repo seulement quand cette checklist est verte.

## Configuration et environnements

La CLI crée `.env` depuis l’exemple. Ne versionnez jamais ce fichier, une base contenant des données réelles, un jeton Preview, un keystore Android ou une clé de service.

| Variable | Usage |
| --- | --- |
| `APP_ENV` | environnement courant |
| `APP_DEBUG` | diagnostics locaux |
| `VELT_PROJECT_TYPE` | profil généré |
| `VELT_STYLING` | preset de style |
| `DB_CONNECTION` | `sqlite`, `mysql` ou `pgsql` |
| `DB_DATABASE` | fichier ou nom de base |

## Déploiement Web/API

1. installez une version PHP supportée et les extensions requises ;
2. lancez `composer install --no-dev --prefer-dist --classmap-authoritative` ;
3. pour Web, construisez avec `npm ci && npm run build` ;
4. servez exclusivement le dossier `public/` ;
5. injectez les secrets hors du dépôt ;
6. migrez avec sauvegarde et stratégie de rollback ;
7. désactivez les diagnostics sensibles ;
8. exécutez les smoke tests après déploiement.

`velt serve` utilise le serveur PHP intégré et reste réservé au développement.

## Développement Android

```text
profil cross-platform -> manifeste de capacités -> Preview réseau
    -> host Android -> PHP embarqué -> JNI -> Jetpack Compose -> APK/AAB
```

Le faux bridge de `velt/native` appartient uniquement à PHPUnit. Une release Android doit prouver le trajet réel PHP -> `nativephp_call()` -> JNI/Kotlin -> Compose -> PHP.

## Dépannage

- `velt` absent : ajoutez le dossier global Composer `vendor/bin` au `PATH`.
- téléphone inaccessible : servez sur `0.0.0.0`, utilisez l’IP LAN et vérifiez le pare-feu.
- Tailwind vide : lancez `npm ci`, vérifiez `content`, puis `npm run build`.
- SQLite absent : activez `pdo_sqlite` pour le PHP réellement utilisé par le terminal.

## Sécurité et contribution

Les paramètres SQL passent par Database/ORM, le HTML par le renderer échappé de UI et l’autorisation reste explicitement applicative. Preview ne doit pas être exposé publiquement sans session signée. Les dépendances sont auditées avant release et aucun secret Android ne doit être committé.

Une modification du skeleton se teste dans trois dossiers propres. Les assertions vérifient les fichiers absents autant que les fichiers présents. Toute dépendance doit être justifiée par profil et toute commande documentée doit fonctionner depuis la racine générée.

## Limites avant stabilité

- préversions Composer à synchroniser proprement avec Packagist ;
- E2E `velt new` à automatiser sur Linux, macOS et Windows ;
- cross-platform bloqué par les gates Android réelles ;
- stratégie de mise à niveau des projets générés à documenter ;
- templates de déploiement et durcissement production à compléter.

## Licence

Velt Skeleton est distribué sous licence MIT.
