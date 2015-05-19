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

    $basePath = \Drupal::root() ."/". drupal_get_path('module', 'ecommerce');

    $file =  $basePath . "/fixtures/node.product.csv";
    $rows = $this->loadCSVFile($file);

    $entityManager = $this->getContainer()->get('entity.manager');

    
    foreach ($rows as $data) {
      $image = $basePath . '/fixtures/images/' . $data[3]; 
      var_dump($image);
      $imageName = rand() ."jpg"; 
      file_unmanaged_copy($image, 'public://' . $imageName . '.jpg');
      $imageEntity = entity_create('file', array(
        'uri' => 'public://' . $imageName . '.jpg',
      ));
      $imageEntity->save();
      $node = $entityManager->getStorage('node')->create(
        array(
          'type' => 'product',
          'title' =>  $data[0],
          'field_price' => (double) $data[1],
          'field_reference' =>  $data[2],
          'body' =>  $data[5],
          'field_image' => $imageEntity
        )
      );
      $node->save();

      $output->writeln("Node " . $node->id() . " created");
    }

  }

  protected function loadCSVFile($file) {
    $rows = [];
    $rowNumber = 1;
    if (($handle = fopen($file, "r")) !== FALSE) {
        
        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
          if ($rowNumber>1) $rows[] = $data;
          $rowNumber++;
        }
          
        fclose($handle);
    }
    return $rows;
  }

}
