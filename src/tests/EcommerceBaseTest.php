<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 21/12/14
 * Time: 21:12
 */

namespace Drupal\ecommerce\Tests;

use Drupal\Tests\UnitTestCase;

class EcommerceBaseTest extends UnitTestCase {

  public function setUpServiceContainerMockUp() {
    $this->container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
      ->setMethods(array('get'))
      ->getMock();

  }

  protected function setMockContainerService($service_name, $return = NULL) {
    $expects = $this->container->expects($this->once())
      ->method('get')
      ->with($service_name);

    if (isset($return)) {
      $expects->will($this->returnValue($return));
    }
    else {
      $expects->will($this->returnValue(TRUE));
    }
  }

  protected function initContainer() {
    $this->setUpServiceContainerMockUp();
  }
  protected function setContainer() {

    \Drupal::setContainer($this->container);
  }

} 