<?php

namespace SilverStripe\ModuleRatingsPlugin;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class RatingsPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        // noop
    }
}
