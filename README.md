# SilverStripe module ratings plugin

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/silverstripe/moduleratings-plugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/silverstripe/moduleratings-plugin/?branch=master)

This package provides a [Composer plugin](https://github.com/silverstripe/silverstripe-contentreview/issues/74) which
enables the functionality for the SilverStripe module ratings package to be used via Composer on the command line.

## Installation

Install with Composer:

```
composer require silverstripe/moduleratings-plugin
```

## Usage

Once installed, you will see a new `rate-module` command. As with other Composer (and Symfony console) commands, you
can add `--help` to the command to see information about what it does and how to use and manipulate it:

```
$ composer rate-module --help

Usage:
  rate-module [options] [--] <module-path>

Arguments:
  module-path                    The path to the module folder, relative to the current working directory

Options:
      --slug[=SLUG]              The module's GitHub repository slug, e.g. silverstripe/silverstripe-blog - used for API checks
  -h, --help                     Display this help message
  -q, --quiet                    Do not output any message
  -V, --version                  Display this application version
      --ansi                     Force ANSI output
      --no-ansi                  Disable ANSI output
  -n, --no-interaction           Do not ask any interactive question
      --profile                  Display timing and memory usage information
      --no-plugins               Whether to disable plugins.
  -d, --working-dir=WORKING-DIR  If specified, use the given directory as working directory.
  -v|vv|vvv, --verbose           Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Help:
  This command will assess the provided module based on a selection of pre-defined quality checks, and provide a rating
  out of 100.
  
  You must provide the module-path to map the path from the current working directory to the source code
  of the module, and you may optionally provide the slug argument which will enable API based status checks.
  
  Note that without providing slug the module will never be able to achieve a 100% score.
```

As noted above, the path to the module's code is required (e.g. `vendor/silverstripe/cms` from your project root).

The `--slug` argument will allow the check suite to run external API based checks, e.g. code coverage and Travis builds.
This is an optional addition, but you won't be able to achieve a 100% score without providing it.

## Example

To run a rating check on the [spam protection module](https://github.com/silverstripe/silverstripe-spamprotection), you
could run the following command:

```
$ composer rate-module vendor/silverstripe/spamprotection/ --slug=silverstripe/silverstripe-spamprotection

+---------------------------------------------------------------------------------------+--------+---------+
| Check description                                                                     | Points | Maximum |
+---------------------------------------------------------------------------------------+--------+---------+
| Has a "good" level of code coverage (greater than 40%, requires slug)                 | 5      | 5       |
| Has a "great" level of code coverage (greater than 60%, requires slug)                | 5      | 5       |
| Has a code of conduct file                                                            | 2      | 2       |
| Has source code in either a "code" or a "src" folder                                  | 5      | 5       |
| The PHP code in this module passes the SilverStripe lint rules (mostly PSR-2)         | 10     | 10      |
| Has a contributing guide file                                                         | 0      | 2       |
| Has a .editorconfig file                                                              | 5      | 5       |
| Has a .gitattributes file                                                             | 2      | 2       |
| Has a license file                                                                    | 5      | 5       |
| Has a readme file                                                                     | 5      | 5       |
| Has Scrutinizer CI configured and a "good" score (greater than 6.5/10, requires slug) | 10     | 10      |
| Has Travis CI configured and the last build passed successfully (requires slug)       | 10     | 10      |
+---------------------------------------------------------------------------------------+--------+---------+
| TOTAL SCORE (normalised)                                                              | 97     | 100     |
+---------------------------------------------------------------------------------------+--------+---------+
```

In the above example you will see the results of each of 
[the checks](https://github.com/silverstripe/moduleratings#available-checks), with the Points that were 
awarded for meeting the check's criteria, and the maximum potential points that could be attained from the check if it
were successful.

The total score is awarded as a percentage, e.g. 97% in this example. Note that the result is normalised, so 97/100
rather than 64/66 (if you'd added each check result up).

## Further info on the checks

For more information on the check suite itself, please see the
[module ratings package](https://github.com/silverstripe/moduleratings). 
