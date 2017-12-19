<?php

namespace SilverStripe\ModuleRatingsPlugin\Command;

use Composer\Command\BaseCommand;
use InvalidArgumentException;
use SilverStripe\ModuleRatings\CheckSuite;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RateModuleCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('rate-module')
            ->setDescription('Assesses a module\'s quality and provides a rating')
            ->setDefinition([
                new InputArgument(
                    'module-path',
                    InputArgument::REQUIRED,
                    'The path to the module folder, relative to the current working directory'
                ),
                new InputOption(
                    'slug',
                    null,
                    InputOption::VALUE_OPTIONAL,
                    "The module's GitHub repository slug, e.g. silverstripe/silverstripe-blog - used for API checks"
                ),
            ])->setHelp(<<<TEXT
This command will assess the provided module based on a selection of pre-defined quality checks, and provide a rating
out of 100.

You must provide the <info>module-path</info> to map the path from the current working directory to the source code
of the module, and you may optionally provide the "github-slug" argument which will enable API based status checks.

Note that without providing <info>github-slug</info> the module will never be able to achieve a 100% score.
TEXT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $modulePath = $input->getArgument('module-path');
        if (empty($modulePath) || !file_exists($modulePath)) {
            throw new InvalidArgumentException('Provided module path "' . $modulePath . '" does not exist!');
        }

        // Make path absolute
        $modulePath = realpath($modulePath);

        $checkSuite = new CheckSuite();

        $checkSuite->setModuleRoot($modulePath);
        if ($slug = $input->getOption('slug')) {
            $checkSuite->setRepositorySlug($slug);
        }

        $checkSuite->run();

        var_dump($checkSuite->getScore()  . ' out of 100');
        print_r($checkSuite->getCheckDetails());
    }
}
