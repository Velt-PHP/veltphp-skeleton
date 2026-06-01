# CHANGES — Velt Skeleton

Résumé des modifications apportées (branche `feat/skeleton-complete`)

- Ajout de helpers `config()` et `env()` dans `src/helpers.php` pour faciliter l'accès à la configuration dans le skeleton.
- Ajout de `bootstrap/app.php` pour charger l'autoload Composer, `.env` et les fichiers `config/*.php`.
- Ajout de `config/app.php` et `config/database.php` et d'un `.env.example`.
- Déplacement de `vlucas/phpdotenv` dans `require` du `composer.json` pour disponibilité runtime.
- Ajout d'un shim CLI minimal `bin/velt` avec la commande `serve` (php built-in server).
- Ajout d'un `README.md` détaillé (usage, presets, CLI guide).
- Ajout de tests unitaires pour les helpers: `tests/Unit/HelpersTest.php` et `tests/Unit/HelpersEdgeCasesTest.php`.
- Ajout d'une base de test `VeltTestCase` et tests d'intégration `tests/Feature/VeltTestCaseUsageTest.php`.
- Corrections diverses du bootstrap et des fichiers de config pour assurer l'exécution des tests.

Notes:
- Ces helpers sont temporaires: l'intention est d'utiliser le `ConfigRepositoryInterface` exposé par le `kernel` lorsque celui-ci sera stabilisé. Une issue a été ajoutée pour demander ce contrat dans le kernel.
- Le fichier `bin/velt` doit être rendu exécutable sur les systèmes Unix (`chmod +x bin/velt`) si vous voulez l'appeler directement.

Tests:
- `composer test` passe localement: current result: OK (7 tests, 19 assertions).
