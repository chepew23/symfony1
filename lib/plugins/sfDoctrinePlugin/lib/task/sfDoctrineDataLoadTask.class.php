<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) Jonathan H. Wage <jonwage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/sfDoctrineBaseTask.class.php');

/**
 * Loads YAML fixture data.
 *
 * @package    symfony
 * @subpackage doctrine
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id$
 */
class sfDoctrineDataLoadTask extends sfDoctrineBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('dir_or_file', sfCommandArgument::OPTIONAL | sfCommandArgument::IS_ARRAY, 'Directory or file to load'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', true),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('no-confirmation', null, sfCommandOption::PARAMETER_NONE, 'Whether to force delete current data of the database')
      new sfCommandOption('charset', null, sfCommandOption::PARAMETER_OPTIONAL, 'Specify charset'),
    ));

    $this->namespace = 'doctrine';
    $this->name = 'data-load';
    $this->briefDescription = 'Loads YAML fixture data';

    $this->detailedDescription = <<<EOF
The [doctrine:data-load|INFO] task loads data fixtures into the database:

  [./symfony doctrine:data-load|INFO]

The task loads data from all the files found in [data/fixtures/|COMMENT].

If you want to load data from specific files or directories, you can append
them as arguments:

  [./symfony doctrine:data-load data/fixtures/dev data/fixtures/users.yml|INFO]
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    sfContext::createInstance($this->configuration);

    $databaseManager = new sfDatabaseManager($this->configuration);
    $environment = $this->configuration instanceof sfApplicationConfiguration ? $this->configuration->getEnvironment() : 'all';

    if (!count($arguments['dir_or_file']))
    {
      // pull default from CLI config array
      $config = $this->getCliConfig();
      $arguments['dir_or_file'] = $config['data_fixtures_path'];
    }

    $options['append'] = false;

    if (
      !$options['no-confirmation']
      &&
      !$this->askConfirmation(array(
        sprintf('This command will remove current data in the following "%s" connection(s):', $environment),
        'Are you sure you want to proceed? (Y/n)',
        'NOTE: If you do not want to proceed in this way, the task appends the data.'
      ),
        'QUESTION_LARGE', true)
    )
    {
      $options['append'] = true;
    }

    $doctrineArguments = array(
      'data_fixtures_path' => $arguments['dir_or_file'],
      'append'             => $options['append'],
      'charset'            => $options['charset'],
    );

    foreach ($arguments['dir_or_file'] as $target)
    {
      $this->logSection('doctrine', sprintf('Loading data fixtures from "%s"', $target));
    }

    $this->callDoctrineCli('load-data', $doctrineArguments);
  }
}
