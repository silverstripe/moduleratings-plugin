<?php

namespace SilverStripe\ModuleRatingsPlugin;

use Composer\Command\BaseCommand;
use Composer\Plugin\Capability\CommandProvider;
use SilverStripe\ModuleRatingsPlugin\Command\RateModuleCommand;

class RatingsCommandProvider implements CommandProvider
{
    /**
     * Retreives an array of commands
     *
     * @return BaseCommand[]
     */
    public function getCommands()
    {
        return [
            new RateModuleCommand(),
        ];
    }
}
