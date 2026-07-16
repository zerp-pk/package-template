# Zerp Package Template

A starter template for building a new [Zerp](https://github.com/zerp-pk) ERP module: a Laravel package with a React/Inertia frontend, following the same structure as every other `zerp/*` module.

## Use this template

Click **"Use this template"** on GitHub (or `gh repo create my-module --template zerp-pk/package-template`) to create a new repo from this skeleton, then:

1. **Rename the placeholder.** Everything here uses `ExamplePackage` / `example-package` as a stand-in for your module name. Replace it everywhere:
   ```bash
   NAME=YourModuleName        # PascalCase, e.g. Invoicing
   SLUG=your-module-slug      # kebab-case, e.g. invoicing
   grep -rl 'ExamplePackage' . --include=*.php --include=*.json --include=*.ts --include=*.tsx | xargs sed -i "s/ExamplePackage/$NAME/g"
   grep -rl 'example-package' . --include=*.json | xargs sed -i "s/example-package/$SLUG/g"
   mv src/Http/Controllers/ExamplePackageItemController.php "src/Http/Controllers/${NAME}ItemController.php" 2>/dev/null
   mv src/Models/ExamplePackageItem.php "src/Models/${NAME}Item.php" 2>/dev/null
   mv src/Providers/ExamplePackageServiceProvider.php "src/Providers/${NAME}ServiceProvider.php" 2>/dev/null
   mv src/Database/Seeders/ExamplePackageDatabaseSeeder.php "src/Database/Seeders/${NAME}DatabaseSeeder.php" 2>/dev/null
   ```
2. Update `composer.json`'s `name` to `zerp/$SLUG` and `description`.
3. Update `module.json`'s `name`, `alias`, and `description`.
4. Build out your module's models, controllers, routes, and React pages under `src/`.
5. Validate before pushing:
   ```bash
   composer validate --strict
   find src -name '*.php' -print0 | xargs -0 -n1 php -l
   ```

## Structure

This mirrors every other Zerp module package:

```
composer.json                          # PSR-4 autoload + Laravel package-discovery provider
module.json                            # module metadata (name, alias, pricing, priority)
src/
  Providers/                           # ServiceProvider + EventServiceProvider
  Http/Controllers/, Http/Requests/    # backend
  Models/                              # Eloquent models
  Database/Migrations/, Database/Seeders/
  Routes/web.php
  Resources/js/Pages/                  # Inertia pages
  Resources/js/menus/                  # company-menu.ts / superadmin-menu.ts sidebar entries
```

## Installing into the main Zerp app

Add a local path repository while developing, then require it:

```json
"repositories": [
    { "type": "path", "url": "../PHPPackages/your-module-slug", "options": { "symlink": true } }
]
```

```bash
composer require zerp/your-module-slug:@dev
```

Laravel's package auto-discovery picks up the service provider automatically - no manual registration needed.

## License

MIT - see [LICENSE](LICENSE).
