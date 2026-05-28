# Velt Skeleton

Projet applicatif minimal installe par `velt new`.

Ce repo est le point d'entree du Module 2 - Skeleton et Developer Experience. Il ne contient pas le framework entier : il assemble les packages du Module 1 (`kernel`, `http`, `ui`, `database`, `cli`) dans une application concrete, executable et testable.

## Etat actuel

Issue 01 - Creer le skeleton installable : implementee.

Le skeleton fournit maintenant :

- un `composer.json` de projet avec dependances Velt locales ;
- un front controller `public/index.php` ;
- un bootstrap applicatif `bootstrap/app.php` ;
- les routes `routes/web.php` et `routes/api.php` ;
- une feature `features/Home` qui rend une page Velt en HTML ;
- un binaire projet `bin/velt` ;
- un `.env.example` ;
- une base PHPUnit de fumee pour valider `/` et `/api/preview/demo`.

## Installation locale

Depuis ce repo :

```bash
composer install
cp .env.example .env
php bin/velt kernel:check
php bin/velt serve --dry-run
composer test
```

Sur Windows PowerShell :

```powershell
composer install
Copy-Item .env.example .env
php bin/velt kernel:check
php bin/velt serve --dry-run
composer test
```

Pour lancer le serveur :

```bash
php bin/velt serve
```

Puis ouvrir `http://127.0.0.1:8000`.

## Routes disponibles

| Methode | Route | Description |
| --- | --- | --- |
| GET | `/` | Rend la page d'accueil Velt en HTML via `Velt\Ui\Renderers\WebRenderer`. |
| GET | `/api/preview/demo` | Retourne une erreur JSON propre quand aucune session preview n'existe. |

Exemple de payload preview sans session :

```json
{
  "success": false,
  "error": {
    "code": "preview_session_missing",
    "message": "No preview session is available for the demo route."
  }
}
```

## Structure

```text
bootstrap/
  app.php
bin/
  velt
config/
  app.php
  database.php
  preview.php
features/
  Home/
    HomePage.php
public/
  index.php
routes/
  api.php
  web.php
tests/
  Feature/
    SkeletonSmokeTest.php
```

## Comment ca marche

`bootstrap/app.php` charge la configuration, instancie `Velt\Kernel\Application`, enregistre les providers HTTP/UI, charge les routes, puis expose le dispatcher HTTP.

`public/index.php` capture la requete HTTP avec `Velt\Http\Request`, la passe au dispatcher, puis envoie la response.

`features/Home/HomePage.php` construit une page declarative avec `Page`, `Card`, `Text` et `Button`, puis la rend en HTML.

`bin/velt` delegue a `Velt\Cli\ApplicationFactory`, ce qui permet d'utiliser les commandes CLI officielles depuis le projet skeleton.

## Objectif Module 2

Le Module 2 transforme les composants bas niveau du Module 1 en experience developpeur concrete :

- creer un projet Velt minimal installable ;
- exposer `.env.example` et `config/*.php` sans reinventer le loader du kernel ;
- proposer des presets d'architecture simples ;
- fournir une base PHPUnit pour applications Velt ;
- aligner les generateurs CLI sur la structure du skeleton ;
- poser les standards de documentation et de contribution.

## Perimetre du repo

Inclus dans ce repo :

- `composer.json` du projet skeleton ;
- `public/index.php` comme front controller ;
- `bin/velt` pour les commandes projet ;
- `config/app.php`, `config/database.php`, `config/preview.php` ;
- `routes/web.php` et `routes/api.php` ;
- structure `features/` par defaut ;
- `.env.example` ;
- presets MVP documentes ;
- tests de fumee du projet genere.

Exclus de ce repo :

- implementation interne du kernel ;
- routeur HTTP complet ;
- moteur UI ;
- ORM avance ;
- systeme de preview mobile avance ;
- generateurs CLI eux-memes, sauf exemples et integration.

## Sous-modules et repos

| Sous-module | Repo cible | Decision |
| --- | --- | --- |
| 01 - Project Skeleton | `Velt-PHP/veltphp-skeleton` | Implementation principale |
| 02 - Architecture Presets | `Velt-PHP/veltphp-skeleton` + `Velt-PHP/veltphp-cli` | Presets dans le skeleton, selection via CLI |
| 03 - Config Environment | `Velt-PHP/veltphp-skeleton` au MVP | Extraire vers `veltphp/config` seulement si l'API devient stable |
| 04 - Testing Foundation | `veltphp/testing` recommande | Peut demarrer comme dossier `tests/` du skeleton avant extraction |
| 05 - Code Generators | `Velt-PHP/veltphp-cli` | Adapter les commandes `make:*` au skeleton |
| 06 - Documentation Standards | `veltphp/docs` recommande | Peut demarrer comme conventions partagees dans ce repo |

## Definition of Done

- `velt new blog` cree un projet minimal depuis ce skeleton.
- `composer install` fonctionne avec les packages Velt locaux via `path repositories`.
- `php bin/velt serve` demarre le projet.
- La route `/` retourne une page Velt rendue en HTML.
- Une route preview JSON expose un contrat d'erreur propre si aucune session n'existe.
- Les presets `monolith-feature`, `api-only` et `mvc-simple` sont documentes.
- Les tests de base peuvent etre lances sans configuration cachee.

## Workflow local attendu

Tant que les packages ne sont pas publies sur Packagist, utiliser des repositories Composer de type `path` :

```json
{
  "repositories": [
    { "type": "path", "url": "../veltphp-kernel/packages/kernel", "options": { "symlink": true } },
    { "type": "path", "url": "../veltphp-http", "options": { "symlink": true } },
    { "type": "path", "url": "../velt-ui", "options": { "symlink": true } },
    { "type": "path", "url": "../velt-database", "options": { "symlink": true } },
    { "type": "path", "url": "../veltphp-cli", "options": { "symlink": true } }
  ]
}
```

Verification minimale :

```bash
composer install
composer dump-autoload
php bin/velt kernel:check
php bin/velt serve --dry-run
composer test
```

Les chemins sont relatifs au dossier `github-repos/`, ce qui permet de travailler en symlink sur les packages locaux sans copier le code.

## Labels GitHub

Les issues Module 2 doivent utiliser les labels suivants :

- `module:2-skeleton-dx`
- `area:skeleton`, `area:cli`, `area:config`, `area:testing`, `area:docs`
- `type:feature`, `type:architecture`, `type:tests`, `type:documentation`
- `priority:p0`, `priority:p1`, `priority:p2`
- `status:ready`

## Ordre de livraison

1. Skeleton installable.
2. Presets MVP.
3. Configuration projet.
4. Base de tests.
5. Generateurs CLI alignes.
6. Standards de documentation.

## Criteres Issue 01

- Le skeleton peut etre clone et installe avec Composer.
- `php bin/velt serve` lance le projet via le serveur PHP local.
- La route `/` retourne une page Velt rendue en HTML.
- La route `/api/preview/demo` retourne une erreur JSON propre si aucune session n'existe.
