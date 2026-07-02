# zerp/package-template

Package Template module for the [Zerp](https://github.com/zerp-pk) ERP platform. Starter template for building a new Zerp module

## Requirements

- PHP 8.2+
- A Laravel application with package auto-discovery enabled (built for Zerp, Laravel 12)

## Installation

```bash
composer require zerp/package-template
```

The package auto-registers via Laravel's package discovery — no manual service provider registration needed.

## What it provides

- `Zerp\ExamplePackage\Providers\ExamplePackageServiceProvider` — boots this module's routes, migrations, and settings
- Frontend pages/components under `src/Resources/js`

## License

MIT — see [LICENSE](LICENSE).
