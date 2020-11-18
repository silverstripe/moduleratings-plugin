<?php

namespace SilverStripe\ModuleRatingsPlugin;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

class RatingsPlugin implements PluginInterface, Capable
{
    public function activate(Composer $composer, IOInterface $io)
    {
        // noop
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
        // noop
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        // noop
    }

    public function getCapabilities()
    {
        return [
            CommandProvider::class => RatingsCommandProvider::class,
        ];
    }
}
