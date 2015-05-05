<?php

/**
 * @file
 * Contains Drupal\ecommerce\Command\FixturesLoadCommand.
 */

namespace Drupal\ecommerce\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\AppConsole\Command\ContainerAwareCommand;

/**
 * Class FixturesLoadCommand.
 *
 * @package Drupal\ecommerce
 */
class FixturesLoadCommand extends ContainerAwareCommand {
  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('ecommerce:fixtures:load')
      ->setDescription($this->trans('command.ecommerce.fixtures.load.description'))
      ->addArgument('name', InputArgument::OPTIONAL, $this->trans('command.ecommerce.fixtures.load.arguments.name'))
      ->addOption('yell', NULL, InputOption::VALUE_NONE, $this->trans('command.ecommerce.fixtures.load.options.yell'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {

    $file = "./fixtures/node.product.csv";

    $entityManager = $this->getContainer()->get('entity.manager');
    //$entityManager->getStorage("node");

    $node = $entityManager->getStorage('node')->create(
      array(
        'type' => 'product',
        'title' => $node->title,
        'price' => '10.0',
        'reference' => 'pr1',
        'body'
      )
    );

    $node->save();

    $name = $input->getArgument('name');
    if ($name) {
      $text = 'Hello ' . $name;
    }
    else {
      $text = 'Hello';
    }

    $text = sprintf(
      '%s, %s: %s',
      $text,
      'I am a new generated command for the module',
      $this->getModule()
    );

    if ($input->getOption('yell')) {
      $text = strtoupper($text);
    }

    $output->writeln($text);

  }

}
