# `slogsdon/composer-multi-package-plugin`

> Facilitates using Composer's path repositories for multi-package / monorepo projects

### Features

- Needs zero configuration
- Needs zero additional tools

### Reasoning

Scratches an itch to manage multi-package / monorepo projects easily.

See [Lerna](https://lernajs.io/) for this project's inspiration.

## Requirements

- [PHP](http://www.php.net/)
- [Composer](https://getcomposer.org/)

## Getting Started

Match the following project layout:

```
project-repository
├── .git
├── .gitignore
├── main-application-or-library
│   ├── composer.json
│   ├── composer.lock
│   ├── src
│   ├── tests
│   └── vendor
└── packages
    ├── package-a
    │   ├── composer.json
    │   ├── src
    │   └── tests
    └── package-b
        ├── composer.json
        ├── src
        └── tests
```

- `project-repository` should contain everything for the entire project including version control bits
- `main-application-or-library` should contain the source code for the main application or library
- `packages/package-a` and `packages/package-b` should contain the source code for additional packages

Require the package in your application/library:

```
cd main-application-or-library
composer require slogsdon/composer-multi-package-plugin
```

Using `slogsdon/composer-multi-package-plugin`, `main-application-or-library` can require the packages defined in `packages/package-a` and `packages/package-b` without manually adding those package directories as `path` repositories.

## License

This project is licensed under the MIT License. See [LICENSE](LICENSE) for details.
