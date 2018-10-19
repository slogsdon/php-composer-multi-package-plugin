<?php

namespace Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Composer plugin to facilitate using Composer's path repositories for multi-package projects
 */
class MultiPackagePlugin implements PluginInterface
{
    /**
     * Current Composer instance
     *
     * @var \Composer\Composer
     */
    protected $composer;

    /**
     * Current Composer IO instance
     *
     * @var \Composer\IO\IOInterface
     */
    protected $io;

    /**
     * Composer plugin entrypoint
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;

        $this->addPackagesPathRepo();
    }

    /**
     * Prepends the return value of `createPackagesPathRepo` to Composer's
     * list of known repositories.
     */
    protected function addPackagesPathRepo()
    {
        $this->composer->getRepositoryManager()->prependRepository(
            $this->createPackagesPathRepo()
        );
    }

    /**
     * Creates a `path` repository pointing to the children of the parent
     * directory's `packages` directory.
     *
     * ### Example
     *
     * With the following project layout:
     *
     * ```
     * project-repository
     * ├── .git
     * ├── .gitignore
     * ├── main-application-or-library
     * │   ├── composer.json
     * │   ├── composer.lock
     * │   ├── src
     * │   ├── tests
     * │   └── vendor
     * └── packages
     *     ├── package-a
     *     │   ├── composer.json
     *     │   ├── src
     *     │   └── tests
     *     └── package-b
     *         ├── composer.json
     *         ├── src
     *         └── tests
     * ```
     *
     * Both `packages/package-a` and `packages/package-b` would be added as
     * `path` repositories.
     *
     * @return \Composer\Repository\RepositoryInterface
     * @see https://getcomposer.org/doc/05-repositories.md#path
     */
    protected function createPackagesPathRepo()
    {
        return $this->composer->getRepositoryManager()->createRepository(
            'path',
            array(
                'url' => '../packages/*',
            )
        );
    }
}
